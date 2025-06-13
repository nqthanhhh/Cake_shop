<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
{
    if (!auth()->check()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Vui lòng đăng nhập để thêm vào giỏ hàng'
        ], 401);
    }

    try {
        // ...existing code...
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
        ], 500);
    }
}

    public function updateCart(Request $request)
    {
        $cart = Cart::findOrFail($request->cart_id);
        $cart->update(['quantity' => $request->quantity]);

        return response()->json([
            'message' => 'Cập nhật giỏ hàng thành công',
            'cartCount' => Cart::where('user_id', auth()->id())->sum('quantity')
        ]);
    }

    public function removeFromCart($id)
    {
        Cart::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Xóa sản phẩm thành công',
            'cartCount' => Cart::where('user_id', auth()->id())->sum('quantity')
        ]);
    }

    public function getCart()
    {
        $cartItems = Cart::with('product')
                        ->where('user_id', auth()->id())
                        ->get();

        return view('cart.index', compact('cartItems'));
    }
}
