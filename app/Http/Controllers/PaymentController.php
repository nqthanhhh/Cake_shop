<?php
// filepath: c:\project-webnc\shop1\Cake_Shop\app\Http\Controllers\PaymentController.php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        $order = Order::where('id', $request->order)
                     ->where('user_id', Auth::id())
                     ->firstOrFail();

        $method = $request->method;

        if ($method === 'momo') {
            return $this->processMoMo($order);
        } elseif ($method === 'vnpay') {
            return $this->processVNPay($order);
        }

        return redirect()->route('order.success', $order->id);
    }

    private function processMoMo($order)
    {
        // Implement MoMo payment gateway
        // Đây chỉ là demo - trong thực tế cần tích hợp API MoMo

        return view('payment.momo', compact('order'));
    }

    private function processVNPay($order)
    {
        // Implement VNPay payment gateway
        // Đây chỉ là demo - trong thực tế cần tích hợp API VNPay

        return view('payment.vnpay', compact('order'));
    }
}
