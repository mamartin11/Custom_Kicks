<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all(); // puedes usar ->select() si quieres limitar campos

        return response()->json($products);
    }
}
