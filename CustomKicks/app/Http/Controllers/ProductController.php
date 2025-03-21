<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function create(): view
    {
        $viewData = [];
        $viewData['title'] = 'Create a product';

        return view('product.create')->with('viewData', $viewData);
    }

    public function index(): view
    {
        $viewData = [];
        $viewData['title'] = 'Products - Online Store';
        $viewData['subtitle'] = 'Our stock';
        $viewData['products'] = Product::all();

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $viewData = [];

        $product = Product::findOrFail($id);

        $viewData['title'] = $product['name'];
        $viewData['subtitle'] = $product['name'];
        $viewData['product'] = $product;

        return view('product.show')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        Product::validate($request);

        $newProduct = new Product;
        $newProduct->setName($request->input('name'));
        $newProduct->setPrice($request->input(key: 'price'));
        $newProduct->setDescription($request->input(key: 'description'));
        $newProduct->setBrand($request->input('brand'));
        $newProduct->setSize($request->input('size'));
        $newProduct->setQuantity($request->input('quantity'));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $newProduct->setImage($imagePath);
        }

        $newProduct->save();
        session()->flash('success', 'Your Senaker has been saved');

        return back();
    }

    public function destroy($id)
    {
        Product::destroy($id);

        return redirect()->route('product.index')->with('success', 'Category deleted successfully!');
    }

    public function edit($id): View
    {
        $viewData = [];
        $product = Product::findOrFail($id);

        $viewData['title'] = 'Edit Product - '.$product->getName();
        $viewData['product'] = $product;

        return view('product.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        Product::validate($request);

        $product = Product::findOrFail($id);
        $product->setName($request->input('name'));
        $product->setPrice($request->input('price'));
        $product->setDescription($request->input('description'));
        $product->setBrand($request->input('brand'));
        $product->setSize($request->input('size'));
        $product->setQuantity($request->input('quantity'));

        // Si hay una nueva imagen, se actualiza
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->setImage($imagePath);
        }

        $product->save();

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }
}
