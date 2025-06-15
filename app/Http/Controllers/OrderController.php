<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Cart;

class OrderController extends Controller
{
    public function checkout()
{
    $cart = Cart::where('user_id', auth()->id())->with('product')->get();

    if ($cart->isEmpty()) {
        return redirect()->route('cart.get')->with('error', 'Giỏ hàng của bạn đang trống!');
    }

    $total = 0;
    foreach ($cart as $item) {
        $total += $item->product->price * $item->quantity;
    }

    $user = Auth::user();

    return view('checkout.index', compact('cart', 'total', 'user'));
}

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'delivery_date' => 'required|date|after:today',
            'notes' => 'nullable|string|max:1000'
        ]);

            $cart = Cart::where('user_id', auth()->id())->with('product')->get();

        if ($cart->isEmpty()) {
            return redirect()->route('cart.get')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        try {
            DB::beginTransaction();

            // Tính tổng tiền
            $totalAmount = 0;
            foreach ($cart as $item) {
                $totalAmount = $cart->sum(fn($item) => $item->product->price * $item->quantity);            }

            // Xác định payment status dựa trên method
            $paymentStatus = 'pending';
            if ($request->payment_method === 'cod') {
                 $paymentStatus = 'pending'; // Sẽ thanh toán khi nhận hàng
            }

            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'notes' => $request->notes,
                'order_date' => Carbon::now(),
                'delivery_date' => Carbon::parse($request->delivery_date)
            ]);

            // Tạo chi tiết đơn hàng
            foreach ($cart as $item) {
                OrderItem::create([
    'order_id' => $order->id,
    'product_name' => $item->product->name,
    'product_price' => $item->product->price,
    'product_image' => $item->product->image,
    'quantity' => $item->quantity,
    'total_price' => $item->product->price * $item->quantity
]);
            }

            // Xóa giỏ hàng
Cart::where('user_id', auth()->id())->delete();
            DB::commit();

            return redirect()->route('order.success', $order->id)
                ->with('success', 'Đơn hàng đã được tạo thành công!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Có lỗi xảy ra khi tạo đơn hàng. Vui lòng thử lại!');
        }
    }

    public function success($orderId)
    {
        $order = Order::with('items')->where('id', $orderId)
                     ->where('user_id', Auth::id())
                     ->firstOrFail();

        return view('checkout.success', compact('order'));
    }

    public function show(Order $order)
{
    // Kiểm tra xem đơn hàng có thuộc về người dùng hiện tại không
    if ($order->user_id !== auth()->id()) {
        abort(403, 'Bạn không có quyền xem đơn hàng này.');
    }

    // Lấy thông tin chi tiết đơn hàng
    $order->load('orderItems.product'); // Giả sử bạn có quan hệ orderItems và product

    return view('orders.show', compact('order'));
}
}
