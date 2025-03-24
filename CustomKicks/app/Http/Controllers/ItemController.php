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
    /**
     * show items
     */
    public function index(): view
    {
        $items = Item::all();

        return view('items.index', [
            'title' => 'Items',
            'items' => $items,
        ]);
    }

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
            'subtotal' => $product->getPrice(), // simple, sin lógica extra
        ];

        // Guardar en la sesión (como array de items)
        $cart = session()->get('cart_items', []);
        $cart[] = $item;
        session()->put('cart_items', $cart);

        // Redirección con mensajes de éxito
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
            $cart = array_values($cart); // Reindexar para evitar huecos
            session()->put('cart_items', $cart);
        }

        return redirect()->route('item.list')->with('success', 'Item removed from cart.');
    }

    public function clearCart(): RedirectResponse
    {
        session()->forget('cart_items');

        return redirect()->route('item.list')->with('success', 'All items removed from cart.');
    }
    
    public function spinDiscountWheel(Request $request, int $id)
    {
        $product = Product::findOrFail($id);
        
        $options = [
            ['type' => 'bonus', 'value' => 100000],
            ['type' => 'discount', 'value' => 20],
            ['type' => 'discount', 'value' => 50],
            ['type' => 'none', 'value' => 0]
        ];

        $result = $options[array_rand($options)];

        $originalPrice = $product->price;
        $finalPrice = $originalPrice;

        if ($result['type'] === 'bonus') {
            $finalPrice = max(0, $originalPrice - $result['value']);
        } elseif ($result['type'] === 'discount') {
            $finalPrice = $originalPrice * (1 - $result['value'] / 100);
        }
        
        sleep(3);

        $cart = session()->get('cart_items', []);

        foreach ($cart as &$item) {
            if ($item['product_id'] == $id) {
                $item['subtotal'] = $finalPrice; // Se actualiza el precio en el carrito
            }
        }
    
        session()->put('cart_items', $cart);
        session()->put('spin_result', $result); // Guardar resultado de la ruleta
    
        return redirect()->route('order.checkout')->with('success', 'The wheel has been spun! Check your new price.');
    }
}
