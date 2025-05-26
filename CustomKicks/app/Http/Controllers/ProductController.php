<?php

// Miguel Angel Martinez, Santiago

namespace App\Http\Controllers;

use App\Models\Customization;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products with optional filtering
     */
    public function index(Request $request): View
    {
        $query = Product::query();

        if ($request->filled('brand')) {
            $query->where('brand', $request->input('brand'));
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        if ($request->filled('size')) {
            $query->where('size', $request->input('size'));
        }

        $brands = Product::select('brand')->distinct()->pluck('brand');

        $viewData = [];
        $viewData['title'] = 'Products - Online Store';
        $viewData['subtitle'] = 'Our stock';
        $viewData['products'] = $query->get();
        $viewData['brands'] = $brands;

        return view('products.index')->with('viewData', $viewData);
    }

    /**
     * Display the specified product with customization options
     */
    public function show(string $id): View
    {
        $viewData = [];

        $product = Product::findOrFail($id);

        $viewData['title'] = $product->getName();
        $viewData['subtitle'] = $product->getName();
        $viewData['product'] = $product;
        $viewData['customizations'] = Customization::all();

        return view('products.show')->with('viewData', $viewData);
    }
}
