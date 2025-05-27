<?php

// Miguel Angel Martinez

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the products for admin.
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['products'] = Product::all();

        return view('admin.products.index')->with('viewData', $viewData);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {

        $viewData = [];
        $viewData['title'] = 'Create a product';

        return view('admin.products.create')->with('viewData', $viewData);
    }

    /**
     * Store a newly created product in storage.
     */
    public function save(Request $request): RedirectResponse
    {

        Product::validate($request);

        $newProduct = new Product;
        $newProduct->setName($request->input('name'));
        $newProduct->setPrice($request->input('price'));
        $newProduct->setDescription($request->input('description'));
        $newProduct->setBrand($request->input('brand'));
        $newProduct->setSize($request->input('size'));
        $newProduct->setQuantity($request->input('quantity'));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $newProduct->setImage($imagePath);
        }

        $newProduct->save();

        return back()->with('success', 'Your Sneaker has been saved');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(string $id): RedirectResponse
    {

        Product::destroy($id);

        return redirect()->route('admin.products.dashboard')->with('success', 'Product deleted successfully!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(string $id): View
    {

        $viewData = [];
        $product = Product::findOrFail($id);

        $viewData['title'] = 'Edit Product - '.$product->getName();
        $viewData['product'] = $product;

        return view('admin.products.edit')->with('viewData', $viewData);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {

        Product::validate($request);

        $product = Product::findOrFail($id);
        $product->setName($request->input('name'));
        $product->setPrice($request->input('price'));
        $product->setDescription($request->input('description'));
        $product->setBrand($request->input('brand'));
        $product->setSize($request->input('size'));
        $product->setQuantity($request->input('quantity'));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->setImage($imagePath);
        }

        $product->save();

        return redirect()->route('admin.products.dashboard')->with('success', 'Product updated successfully!');
    }
}
