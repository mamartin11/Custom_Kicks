<?php

// Miguel Angel Martinez, Santiago

namespace App\Http\Controllers;

use App\Models\Customization;
use App\Models\Product;
use App\Services\ExternalProductService;
use Illuminate\Http\RedirectResponse;
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

    public function externalProducts(ExternalProductService $externalProductService): View|RedirectResponse
    {
        $products = $externalProductService->getProducts();

        if (is_null($products)) {
            // Handle the case where products could not be fetched
            // You might want to return a view with an error message
            // or redirect back with an error.
            return back()->with('error', 'Unable to fetch products from the external source at this time.');
        }

        // Pass the base URL for images to the view as well, or handle it in the service
        $imageBaseUrl = rtrim(env('EXTERNAL_PRODUCT_API_URL'), '/');

        return view('products.external_index', [
            'products' => $products,
            'externalProductService' => $externalProductService, // To use getFullImageUrl in the view
            'pageTitle' => 'External Products', // Optional: for consistency if you use $pageTitle
        ]);
    }
}
