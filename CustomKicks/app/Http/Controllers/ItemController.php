<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\Customization;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function show(string $id): View
    {
        $viewData = [];

        $product = Product::findOrFail($id);

        $viewData['title'] = $product['name'];
        $viewData['subtitle'] = $product['name'];
        $viewData['product'] = $product;
        $viewData['customizations'] = Customization::all();

        return view('item.index')->with('viewData', $viewData);
    }

    public function applyCustomization(Request $request)
    {

        $customization = Customization::findOrFail($request->input('id'));

        return redirect()->route('item.show', $request->input('product_id'))->with([
            'success' => 'Customization applied successfully!',
            'selected_color' => $customization->getColor(),
            'selected_design' => $customization->getDesign(),
            'selected_pattern' => $customization->getPattern(),
        ]);

    }

    public function store(Request $request): RedirectResponse
    {
    
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'customization_id' => 'nullable|integer|exists:customizations,id',
        ]);
 
        $product = Product::findOrFail($request->input('product_id'));
        $customization = Customization::find($request->input('customization_id'));
 
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
 
        
        session()->push('cart_items', $item);
 
        
        $viewData = [
            'success' => 'Customization applied and item added to cart.',
            'selected_color' => $customization->getColor(),
            'selected_design' => $customization->getDesign(),
            'selected_pattern' => $customization->getPattern(),
        ];
 
        return redirect()->route('item.list')->with($viewData);
    }
 
    public function list(): View
    {
        $viewData = [
            'title' => 'Your Cart Items',
            'cartItems' => session()->get('cart_items', []),
        ];
 
        return view('item.list')->with('viewData', $viewData);
    }
 
    public function removeFromCart(int $index): RedirectResponse
    {
        $cart = session()->get('cart_items', []);
 
        if (isset($cart[$index])) {
            unset($cart[$index]);
            session()->put('cart_items', array_values($cart));
        }
 
        return redirect()->route('item.list')->with('success', 'Item removed from cart.');
    }
 
    public function clearCart(): RedirectResponse
    {
        session()->forget('cart_items');
 
        return redirect()->route('item.list')->with('success', 'All items removed from cart.');
    }
 
}
