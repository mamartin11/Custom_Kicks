<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ItemController extends Controller 
{
    
    /**
     * show items
     */
    public function index() : view 
    {
        $items = Item::all();

        return view('items.index', [
            "title" => "Items",
            "items"=> $items
        ]);
    }

    /**
     * Add item in a order
     */

    public function create(): View
    {
        return view('items.add', ["title" => "Añadir item"]);
    }
 
    public function store(Request $request): RedirectResponse {
        $request->validate([
            "product_id" => "required|integer|min:1",
            "customization_id" => "nullable|integer|min:1",
            "order_id" => "required|integer|min:1",
            "product_price" => "required|integer|min:1",
        ]);

        Item::create([
            "product_id" => $request->input("product_id"),
            "customization_id" => $request->input("customization_id"),
            "order_id" => $request->input("order_id"),
            "subtotal" => $request->input("product_price"),
        ]);

        //$product = Product::findOrFail($request->product_id);
        //$item->product_price = $request->product_price;
        //$subtotal = $product->price;
        //$item->subtotal = $item->calculateSubtotal();
        
        return redirect()->route('items.index')->with('success', 'item registrado correctamente.');
    }

    /**
     * Show one item
     */
    public function show($id) {
        $item = Item::with(['product', 'customization', 'order'])->findOrFail($id);
        return response()->json($item);
    }

    /**
     * Delete a item from a order
     */
    public function destroy($id) {
        $item = Item::findOrFail($id);
        $item->delete();

       return response()->json(['message' => 'Item deleted correctly']);    
    }
}
