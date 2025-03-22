<?php

namespace App\Http\Controllers;

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

    public function store(Request $request) {}
}
