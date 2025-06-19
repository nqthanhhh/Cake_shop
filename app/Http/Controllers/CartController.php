<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

public function addToCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|integer',
        'quantity' => 'required|integer|min:1'
    ]);

    $productId = $request->product_id;
    $quantity = $request->quantity;

    // Kiểm tra sản phẩm có tồn tại hay không
    $product = \App\Models\Product::find($productId);
    if (!$product) {
        return response()->json([
            'success' => false,
            'message' => 'Sản phẩm không tồn tại.'
        ]);
    }

    // Kiểm tra số lượng tồn kho
    if ($quantity > $product->stock) {
        return response()->json([
            'success' => false,
            'message' => 'Số lượng sản phẩm không đủ trong kho.'
        ]);
    }

    if (auth()->check()) {
        // Lưu vào cơ sở dữ liệu nếu người dùng đã đăng nhập
        $cart = Cart::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $productId],
            ['quantity' => DB::raw("quantity + $quantity")]
        );

        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng!',
            'cart_count' => Cart::where('user_id', auth()->id())->count()
        ]);
    } else {
        // Lưu vào session nếu chưa đăng nhập
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $quantity
            ];
        }
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng!',
            'cart_count' => count($cart)
        ]);
    }
}

    public function getCart()
{
    if (auth()->check()) {
        // Lấy giỏ hàng từ cơ sở dữ liệu
        $cart = Cart::where('user_id', auth()->id())->with('product')->get();
        $total = $cart->sum(fn($item) => $item->product->price * $item->quantity);


    } else {
        // Lấy giỏ hàng từ session
        $cart = Session::get('cart', []);
        $total = array_reduce($cart, fn($sum, $item) => $sum + $item['price'] * $item['quantity'], 0);
    }

    return view('cart.index', compact('cart', 'total'));
}

public function updateCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|integer',
        'quantity' => 'required|integer|min:1'
    ]);

    $productId = $request->product_id;
    $quantity = $request->quantity;

    if (auth()->check()) {
        // Kiểm tra sản phẩm trong giỏ hàng
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Cập nhật số lượng
            $cartItem->quantity = $quantity;
            $cartItem->save();

            // Tính toán lại tổng giá trị
            $cart = Cart::where('user_id', auth()->id())->with('product')->get();
            $subtotal = $cart->sum(fn($item) => $item->product->price * $item->quantity);

            return response()->json([
                'success' => true,
                'message' => 'Giỏ hàng đã được cập nhật!',
                'item_total' => $cartItem->product->price * $cartItem->quantity,
                'subtotal' => $subtotal,
                'total' => $subtotal
            ]);
        }
    }

    return response()->json([
        'success' => false,
        'message' => 'Sản phẩm không tồn tại trong giỏ hàng!'
    ]);
}

    public function removeFromCart($id)
{
    if (auth()->check()) {
        // Xóa sản phẩm khỏi cơ sở dữ liệu
        Cart::where('user_id', auth()->id())->where('product_id', $id)->delete();
    } else {
        // Xóa sản phẩm khỏi session
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);
    }

    return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng!']);
}

    /**
     * Xóa nhiều sản phẩm khỏi giỏ hàng
     */
    public function removeMultiple(Request $request)
{
    $request->validate([
        'product_ids' => 'required|array',
        'product_ids.*' => 'integer',
    ]);
    $ids = $request->product_ids;
    if (auth()->check()) {
        Cart::where('user_id', auth()->id())
            ->whereIn('product_id', $ids)
            ->delete();
    } else {
        $cart = Session::get('cart', []);
        foreach ($ids as $id) {
            unset($cart[$id]);
        }
        Session::put('cart', $cart);
    }
    return response()->json(['success' => true, 'message' => 'Đã xóa các sản phẩm đã chọn!']);
}

    public function getCartCount()
{
    $cartCount = 0;

    if (auth()->check()) {
        // Lấy số lượng sản phẩm trong giỏ hàng từ cơ sở dữ liệu
        $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');
    }

    return response()->json(['count' => $cartCount]);
}
}
