<?php

// Jacobo Restrepo

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Process checkout and create a new order
     */
    public function checkout(): View|RedirectResponse
    {
        $cartItems = session()->get('cart_items', []);

        // Check if cart is empty
        if (empty($cartItems)) {
            return redirect()->route('cart.list')
                ->with('error', __('cart/list.empty_cart_error'));
        }

        $total = array_sum(array_column($cartItems, 'subtotal'));
        $userBudget = Auth::user()->getBudget() ?? 0;

        // Validar que el usuario tenga suficiente budget
        if ($userBudget < $total) {
            return redirect()->route('cart.list')
                ->with('error', __('cart/list.insufficient_budget', [
                    'total' => number_format($total, 2),
                    'budget' => number_format($userBudget, 2),
                ]));
        }

        $remainingBudget = $userBudget - $total;

        $order = new Order;
        $order->setTotal($total);
        $order->setOrderDate(now()->toDateString());
        $order->setUserId(Auth::user()->getId());
        $order->setDetails($cartItems);
        $order->save();

        // Clear the cart after successful order
        session()->forget('cart_items');

        $viewData = [];
        $viewData['title'] = 'Order Summary';
        $viewData['items'] = $cartItems;
        $viewData['total'] = $total;
        $viewData['userBudget'] = $userBudget;
        $viewData['remainingBudget'] = $remainingBudget;

        return view('order.checkout')->with('viewData', $viewData);
    }

    /**
     * List orders for the authenticated user
     */
    public function myOrders(): View
    {
        $user = Auth::user();
        $orders = $user->orders()->orderBy('created_at', 'desc')->get();

        $viewData = [];
        $viewData['orders'] = $orders;

        return view('order.my-orders')->with('viewData', $viewData);
    }

    /**
     * Update discount for the latest order and update user budget
     */
    public function updateDiscount(Request $request)
    {
        $user = Auth::user();

        // Obtener la orden más reciente del usuario
        $order = $user->orders()->latest()->first();

        if (! $order) {
            return response()->json(['success' => false, 'message' => 'No order found'], 404);
        }

        $discount = $request->input('discount', 0);
        $order->setDiscount($discount);

        // Calcular el total final con descuento aplicado
        $originalTotal = $order->getTotal();
        $discountAmount = ($originalTotal * $discount) / 100;
        $finalTotal = $originalTotal - $discountAmount;

        // Actualizar el budget del usuario
        $currentBudget = $user->getBudget();
        $newBudget = $currentBudget - $finalTotal;
        $user->setBudget($newBudget);

        // Guardar ambos cambios
        $order->save();
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Discount and budget updated successfully',
            'original_total' => $originalTotal,
            'discount_amount' => $discountAmount,
            'final_total' => $finalTotal,
            'new_budget' => $newBudget,
        ]);
    }
}
