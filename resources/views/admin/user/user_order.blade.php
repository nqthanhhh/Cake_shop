@extends('admin.layouts')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <main class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Chi tiết đơn hàng #{{ $order->order_number }}</h1>
        <div class="bg-white p-6 rounded shadow mb-8">
            <p><strong>Người đặt hàng:</strong> {{ $order->customer_name }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount) }}đ</p>
            <p><strong>Trạng thái:</strong> {{ $order->getStatusInVietnamese() }}</p>
            <p><strong>Địa chỉ giao hàng:</strong> {{ $order->customer_address ?? 'Chưa cập nhật' }}</p>
            <p><strong>Ngày giờ giao hàng:</strong> {{ $order->delivery_date ? $order->delivery_date->format('d/m/Y') : 'Chưa cập nhật' }} {{ $order->delivery_time ?? '' }}</p>

        </div>
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Danh sách sản phẩm</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên sản phẩm</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->product_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($item->product_price) }}đ</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($item->product_price * $item->quantity) }}đ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ url()->previous() }}" class="inline-block mt-6 text-primary hover:underline">&larr; Quay lại</a>
    </main>
</div>
@endsection
