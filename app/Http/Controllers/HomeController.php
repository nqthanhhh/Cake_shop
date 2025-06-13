<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
                          ->where('is_featured', true)
                          ->latest()
                          ->get();

        return view('front.index', compact('products'));
    }
}
