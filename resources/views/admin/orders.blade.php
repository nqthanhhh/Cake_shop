@extends('admin.layouts')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <main class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Xác nhận đơn hàng</h1>
        <div class="bg-white p-6 rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã đơn hàng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
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
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->customer_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($order->total_amount) }}đ</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($order->status === 'pending')
                                <span class="text-blue-400 font-bold flex items-center"><i class="fas fa-times mr-1"></i> Chưa xác nhận</span>
                            @elseif($order->status === 'confirmed')
                                <span class="text-green-600 font-bold flex items-center"><i class="fas fa-check mr-1"></i> Đã xác nhận</span>
                            @elseif($order->status === 'rejected')
                                <span class="text-red-600 font-bold flex items-center"><i class="fas fa-times mr-1"></i> Đã từ chối</span>
                            @elseif($order->status === 'shipping')
                                <span class="text-yellow-500 font-bold flex items-center"><i class="fas fa-truck mr-1"></i> Đang giao hàng</span>
                            @elseif($order->status === 'cancelled')
                                <span class="text-red-600 font-bold flex items-center"><i class="fas fa-times mr-1"></i> Đã huỷ</span>
                            @else
                                <span class="text-gray-400 font-bold flex items-center">{{ $order->status }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($order->status === 'pending')
                            <form action="{{ route('admin.user.order_confirm', $order->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-800 mr-2" title="Xác nhận">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.user.order_reject', $order->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800" title="Từ chối">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                            @elseif($order->status === 'confirmed')
                            <form action="{{ route('admin.user.order_shipping', $order->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="text-yellow-600 hover:text-yellow-800" title="Đang giao hàng">
                                    <i class="fas fa-truck"></i>
                                </button>
                            </form>
                            @else
                            <span class="text-gray-400"><i class="fas fa-check"></i></span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="{{ route('admin.user.user_order', $order->id) }}" class="text-blue-600 hover:text-blue-800 mr-2" title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
