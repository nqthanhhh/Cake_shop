@extends('front.layout.master')

@section('title', 'Theo dõi đơn hàng')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Theo dõi đơn hàng</h1>
    @if($orders->count())
    <div class="bg-white p-6 rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã đơn hàng</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày đặt</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng tiền</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($orders as $order)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">#{{ $order->order_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($order->total_amount) }}đ</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($order->status === 'pending')
                            <span class="text-red-500 font-bold flex items-center"><i class="fas fa-times mr-1"></i> Chưa xác nhận</span>
                        @elseif($order->status === 'confirmed')
                            <span class="text-green-600 font-bold flex items-center"><i class="fas fa-check mr-1"></i> Đã xác nhận</span>
                        @elseif($order->status === 'rejected')
                            <span class="text-gray-600 font-bold flex items-center"><i class="fas fa-times mr-1"></i> Đã từ chối</span>
                        @elseif($order->status === 'shipping')
                            <span class="text-yellow-500 font-bold flex items-center"><i class="fas fa-truck mr-1"></i> Đang vận chuyển</span>
                        @elseif($order->status === 'cancelled')
                            <span class="text-red-600 font-bold flex items-center"><i class="fas fa-times mr-1"></i> Đã huỷ</span>
                        @else
                            <span class="text-gray-400 font-bold flex items-center">{{ $order->status }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('order.show', $order->id) }}" class="text-blue-600 hover:underline">Xem chi tiết</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="text-center py-16">
        <div class="text-6xl text-gray-300 mb-4">
            <i class="ri-shopping-cart-line"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-600 mb-4">Bạn chưa có đơn hàng nào</h3>
        <p class="text-gray-500 mb-6">Hãy bắt đầu mua sắm để tạo đơn hàng đầu tiên của bạn!</p>
        <a href="{{ route('home') }}" class="bg-primary text-white px-6 py-3 rounded-button hover:bg-opacity-90 transition-colors">
            Bắt đầu mua sắm
        </a>
    </div>
    @endif
</div>
@endsection
