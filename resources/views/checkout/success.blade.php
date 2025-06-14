@extends('front.layout.master')

@section('title', 'Đặt hàng thành công - Sweet Cake')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto text-center">
        <div class="bg-green-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
            <i class="ri-check-line text-green-600 text-3xl"></i>
        </div>

        <h1 class="text-3xl font-bold text-green-600 mb-4">Đặt hàng thành công!</h1>
        <p class="text-gray-600 mb-8">Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận đơn hàng.</p>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Thông tin đơn hàng</h2>

            <div class="grid grid-cols-2 gap-4 text-left">
                <div>
                    <p class="text-gray-600">Mã đơn hàng:</p>
                    <p class="font-semibold">#{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Tổng tiền:</p>
                    <p class="font-semibold text-primary">{{ number_format($order->total_amount) }}đ</p>
                </div>
                <div>
                    <p class="text-gray-600">Ngày giao hàng:</p>
                    <p class="font-semibold">{{ $order->delivery_date->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Trạng thái:</p>
                    <p class="font-semibold text-yellow-600">{{ $order->getStatusInVietnamese() }}</p>
                </div>
            </div>
        </div>

        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="bg-primary text-white px-6 py-3 rounded-md hover:bg-opacity-90 transition-colors">
                Xem đơn hàng
            </a>
            <a href="{{ route('home') }}" class="bg-gray-500 text-white px-6 py-3 rounded-md hover:bg-gray-600 transition-colors">
                Tiếp tục mua sắm
            </a>
        </div>
    </div>
</div>
@endsection
