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
    public function checkout(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->with('product')->get();
        $selected = $request->selected_products;
        if (!empty($selected)) {
            // Đảm bảo $selected là mảng
            if (!is_array($selected)) {
                $selected = explode(',', $selected);
            }
            $cart = $cart->whereIn('product_id', $selected);
        }
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
            'province' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'specific_address' => 'required|string|max:500',
            'delivery_date' => 'required|date|after:today',
            'delivery_hour' => 'required|integer|min:1|max:12',
            'delivery_minute' => 'required|integer|min:0|max:59',
            'delivery_ampm' => 'required|string|in:AM,PM',
            'notes' => 'nullable|string|max:1000',
            'selected_products' => 'nullable|array',
            'selected_products.*' => 'integer',
        ]);

        $customerAddress = $request->province . ', ' . $request->district . ', ' . $request->ward . ', ' . $request->specific_address;

        $cart = Cart::where('user_id', auth()->id())->with('product')->get();
        $selected = $request->selected_products;
        if (!empty($selected)) {
            if (!is_array($selected)) {
                $selected = explode(',', $selected);
            }
            $cart = $cart->whereIn('product_id', $selected);
        }
        if ($cart->isEmpty()) {
            return redirect()->route('cart.get')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        try {
            DB::beginTransaction();
            $totalAmount = $cart->sum(fn($item) => $item->product->price * $item->quantity);
            $deliveryTime = $request->delivery_hour . ':' . $request->delivery_minute . ' ' . $request->delivery_ampm;
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $customerAddress,
                'notes' => $request->notes,
                'order_date' => Carbon::now(),
                'delivery_date' => Carbon::parse($request->delivery_date),
                'delivery_time' => $deliveryTime,
            ]);

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

            // Xóa các sản phẩm đã đặt khỏi giỏ hàng
            Cart::where('user_id', auth()->id())
                ->whereIn('product_id', $cart->pluck('product_id'))
                ->delete();

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

    public function tracking()
    {
        $orders = \App\Models\Order::where('user_id', auth()->id())->latest()->get();
        return view('front.order_tracking', compact('orders'));
    }

    public function cancelOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Kiểm tra xem đơn hàng có thuộc về người dùng hiện tại không
        if ($order->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Bạn không có quyền hủy đơn hàng này!');
        }

        // Chỉ cho phép hủy đơn hàng khi đang ở trạng thái pending
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Đơn hàng đã được xác nhận, không thể hủy!');
        }

        // Cập nhật trạng thái đơn hàng thành cancelled
        $order->status = 'cancelled';
        $order->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công!');
    }

    public function confirmCancelOrder($orderId)
    {
        // Method này có thể được sử dụng cho xác nhận hủy đơn hàng nếu cần
        return $this->cancelOrder($orderId);
    }

    public function updateShippingStatus($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Kiểm tra xem trạng thái hiện tại có cho phép chuyển sang "Đang vận chuyển" không
        if ($order->status !== 'confirmed') {
            return redirect()->back()->with('error', 'Chỉ có thể chuyển trạng thái đơn hàng sang "Đang vận chuyển" sau khi đã xác nhận!');
        }

        // Cập nhật trạng thái đơn hàng
        $order->status = 'shipping';
        $order->save();

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật thành "Đang vận chuyển"!');
    }
}
