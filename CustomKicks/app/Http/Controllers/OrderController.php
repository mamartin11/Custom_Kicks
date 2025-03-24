<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

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
        ]);
    }

}
