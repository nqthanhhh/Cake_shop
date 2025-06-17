<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        $products = Product::where('is_featured', true)->get(); // Lấy sản phẩm nổi bật

        return view('front.index', compact('categories', 'products'));
    }
}
