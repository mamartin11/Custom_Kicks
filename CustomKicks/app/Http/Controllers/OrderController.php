<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(): View
    {
        $cartItems = session()->get('cart_items', []);
        $total = array_sum(array_column($cartItems, 'subtotal'));
        $userBudget = auth()->user()->budget ?? 0;
        $remainingBudget = $userBudget - $total;

        $order = new Order();
        $order->setTotal($total);
        $order->setOrderDate(now()->toDateString()); // Guardar fecha actual como `order_date`
        $order->user_id = auth()->user()->id; // Guardar ID del usuario autenticado
        $order->setDetails($cartItems);
        $order->save();
        
        return view('order.checkout', [
            'title' => 'Order Summary',
            'items' => $cartItems,
            'total' => $total,
            'userBudget' => $userBudget,
            'remainingBudget' => $remainingBudget,
        ]);
    }

}
