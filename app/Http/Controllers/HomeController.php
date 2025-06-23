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
        $products = Product::with('reviews')->where('is_featured', true)->get(); // Lấy sản phẩm nổi bật cùng với reviews

        return view('front.index', compact('categories', 'products'));
    }

    public function terms()
    {
        return view('front.terms');
    }

    public function privacy()
    {
        return view('front.privacy');
    }
}
