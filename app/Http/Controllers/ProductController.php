<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Review;


class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with(['reviews' => function($query) {
            $query->latest()->with('user');
        }])->findOrFail($id);
        $categories = Category::all(); // Lấy tất cả danh mục

        return view('front.product', compact('product', 'categories'));
    }
}
