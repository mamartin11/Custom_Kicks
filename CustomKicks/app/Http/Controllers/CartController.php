<?php

// Created by refactoring ItemController

namespace App\Http\Controllers;

use App\Models\Customization;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * List all items in the cart
     */
    public function listItems(): View
    {
        $cartItems = session()->get('cart_items', []);

        $viewData = [];
        $viewData['title'] = 'Your Cart Items';
        $viewData['cartItems'] = $cartItems;

        return view('cart.list')->with('viewData', $viewData);
    }

    /**
     * Add an item to the cart
     */
    public function addToCart(Request $request): RedirectResponse
    {
        $product = Product::findOrFail($request->input('product_id'));
        $customization = Customization::findOrFail($request->input('customization_id'));

        $item = [
            'product_id' => $product->getId(),
            'product_name' => $product->getName(),
            'price' => $product->getPrice(),
            'customization_id' => $customization->getId(),
            'customization' => [
                'color' => $customization->getColor(),
                'design' => $customization->getDesign(),
                'pattern' => $customization->getPattern(),
            ],
            'subtotal' => $product->getPrice(),
        ];

        $cart = session()->get('cart_items', []);
        $cart[] = $item;
        session()->put('cart_items', $cart);

        return redirect()->route('cart.list')
            ->with('success', 'Item added to cart successfully.')
            ->with('selected_color', $customization->getColor())
            ->with('selected_design', $customization->getDesign())
            ->with('selected_pattern', $customization->getPattern());
    }

    /**
     * Remove an item from the cart
     */
    public function removeFromCart(int $index): RedirectResponse
    {
        $cart = session()->get('cart_items', []);

        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart);
            session()->put('cart_items', $cart);
        }

        return redirect()->route('cart.list')->with('success', 'Item removed from cart.');
    }

    /**
     * Clear all items from the cart
     */
    public function clearCart(): RedirectResponse
    {
        session()->forget('cart_items');

        return redirect()->route('cart.list')->with('success', 'All items removed from cart.');
    }
}
