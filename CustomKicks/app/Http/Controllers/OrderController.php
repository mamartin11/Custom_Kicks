<?php

namespace App\Http\Controllers;

class OrderController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Orders details';
        $viewData['current_time'] = date('Y-m-d H:i:s');

        return view('order.index')->with('viewData', $viewData);
    }
}
