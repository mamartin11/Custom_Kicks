<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(): view
    {
        $viewData = [];
        $viewData['title'] = 'Products - Online Store';
        $viewData['subtitle'] = 'Our stock';
        $viewData['products'] = Product::all();

        return view('product.index')->with('viewData', $viewData);
    }

}