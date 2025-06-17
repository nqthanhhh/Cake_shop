<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id); // Tìm sản phẩm theo ID
        return view('front.product', compact('product')); // Trả về view chi tiết sản phẩm
    }
}
