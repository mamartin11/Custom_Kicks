<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function checkout(): View
    {
        $cartItems = session()->get('cart_items', []);
        $total = array_sum(array_column($cartItems, 'subtotal'));
        $userBudget = auth()->user()->budget ?? 0;
        $remainingBudget = $userBudget - $total;

        return view('order.checkout', [
            'title' => 'Order Summary',
            'items' => $cartItems,
            'total' => $total,
            'userBudget' => $userBudget,
            'remainingBudget' => $remainingBudget,
            'spinResult' => session()->get('spin_result', null) // Para mostrar el resultado en la vista
        ]);
    }

    public function confirmOrder()
    {
        $user = auth()->user();
        $cartItems = session()->get('cart_items', []);
        $total = array_sum(array_column($cartItems, 'subtotal'));

        if ($user->budget < $total) {
            return redirect()->route('order.checkout')->with('error', 'Insufficient budget to complete the purchase.');
        }

        // Guardar la orden en la BD
        $order = new Order();
        $order->user_id = $user->id;
        $order->total = $total;
        $order->save();

        // Guardar los items de la orden
        foreach ($cartItems as $item) {
            Item::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'customization_id' => $item['customization_id'],
                'price' => $item['subtotal'],
            ]);
        }

        // Actualizar el budget del usuario
        $user->budget -= $total;
        $user->save();

        // Vaciar el carrito
        session()->forget('cart_items');

        return redirect()->route('order.checkout')->with('success', 'Order confirmed successfully!');
    }
}
