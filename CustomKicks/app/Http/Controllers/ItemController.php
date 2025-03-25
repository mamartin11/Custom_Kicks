<?php
// Santiago Rodriguez
// Jacobo Restrepo
namespace App\Http\Controllers;

use App\Models\Customization;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function show(string $id): View
    {
        $viewData = [];

        $product = Product::findOrFail($id);

        $viewData['title'] = $product->getName();
        $viewData['subtitle'] = $product->getName();
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
        $product = Product::find($request->input('product_id'));
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

        $cart = session()->get('cart_items', []);
        $cart[] = $item;
        session()->put('cart_items', $cart);

        return redirect()->route('item.list')
            ->with('success', 'Customization applied and item added to cart.')
            ->with('selected_color', $customization->getColor())
            ->with('selected_design', $customization->getDesign())
            ->with('selected_pattern', $customization->getPattern());
    }

    public function list(): View
    {
        $cartItems = session()->get('cart_items', []);

        return view('item.list', [
            'title' => 'Your Cart Items',
            'cartItems' => $cartItems,
        ]);
    }

    public function removeFromCart(int $index): RedirectResponse
    {
        $cart = session()->get('cart_items', []);

        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart);
            session()->put('cart_items', $cart);
        }

        return redirect()->route('item.list')->with('success', 'Item removed from cart.');
    }

    public function clearCart(): RedirectResponse
    {
        session()->forget('cart_items');

        return redirect()->route('item.list')->with('success', 'All items removed from cart.');
    }

    public function saveItemsToDatabase(): RedirectResponse
    {

        $cartItems = session()->get('cart_items', []);

        if (empty($cartItems)) {

            return redirect()->route('item.list')->with('error', 'No items to save.');

        }

        foreach ($cartItems as $cartItem) {

            Item::create([

                'product_id' => $cartItem['product_id'],

                'customization_id' => $cartItem['customization_id'] ?? null,

                'subtotal' => $cartItem['subtotal'],

            ]);

        }

        return redirect()->route('item.list')->with('success', 'Items saved successfully!');

    }
}
