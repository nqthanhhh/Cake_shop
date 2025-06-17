<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;


class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Lấy tất cả danh mục

        return view('front.product', compact('product', 'categories'));
    }
}
