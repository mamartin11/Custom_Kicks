<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index() {
        $viewData = [];
        $viewData['title'] = "Custom Sneakers - Home";
        $viewData['subtitle'] = "Galería de Sneakers Personalizados";
        $viewData['products'] = Product::all();
        $viewData['newest'] = Product::latest()->take(3)->get();
        return view('home.index')->with('viewData', $viewData);
    }
}
