<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }
        $viewData = [];
        $viewData['products'] = Product::all();

        return view('admin.dash')->with('viewData', $viewData);
    }

    public function create(): view
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }
        $viewData = [];
        $viewData['title'] = 'Create a product';

        return view('product.create')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }
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
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }

        Product::destroy($id);

        return redirect()->route('product.index')->with('success', 'Category deleted successfully!');
    }

    public function edit($id): View
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }

        $viewData = [];
        $product = Product::findOrFail($id);

        $viewData['title'] = 'Edit Product - '.$product->getName();
        $viewData['product'] = $product;

        return view('product.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }

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

        return redirect()->route('admin.dash')->with('success', 'Product updated successfully!');
    }
}
