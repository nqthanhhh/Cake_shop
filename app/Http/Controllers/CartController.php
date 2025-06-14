<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'product_name' => 'required|string',
            'product_price' => 'required|numeric',
            'product_image' => 'required|string',
            'quantity' => 'integer|min:1'
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        // Lấy giỏ hàng từ session
        $cart = Session::get('cart', []);

        // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $cart[$productId] = [
                'id' => $productId,
                'name' => $request->product_name,
                'price' => $request->product_price,
                'image' => $request->product_image,
                'quantity' => $quantity
            ];
        }

        // Lưu giỏ hàng vào session
        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng!',
            'cart_count' => count($cart)
        ]);
    }

    public function getCart()
    {
        $cart = Session::get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            Session::put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Giỏ hàng đã được cập nhật!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Sản phẩm không tồn tại trong giỏ hàng!'
        ]);
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng!',
                'cart_count' => count($cart)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Sản phẩm không tồn tại trong giỏ hàng!'
        ]);
    }

    public function getCartCount()
    {
        $cart = Session::get('cart', []);
        return response()->json(['count' => count($cart)]);
    }
}
