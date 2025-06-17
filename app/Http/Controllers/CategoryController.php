<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products; // Giả sử bạn đã thiết lập quan hệ trong model

        return view('front.category', compact('category', 'products'));
    }
}
