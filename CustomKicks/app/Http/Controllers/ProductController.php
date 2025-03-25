<?php
// Miguel Angel Martinez, Santiago
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): view
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

        return view('product.index')->with('viewData', $viewData);
    }
}
