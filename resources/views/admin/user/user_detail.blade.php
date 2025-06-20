@extends('admin.layouts')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <main class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Chi tiết tài khoản</h1>
        <div class="bg-white p-6 rounded shadow mb-8">
            <h2 class="text-xl font-semibold mb-4">Thông tin người dùng</h2>
            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>Tên:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $user->phone ?? 'Chưa cập nhật' }}</p>
            <p><strong>Địa chỉ:</strong> {{ $user->address ?? 'Chưa cập nhật' }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Đơn hàng đã đặt</h2>
            @if($orders->count())
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
                                <span class="text-gray-500 font-bold flex items-center"><i class="fas fa-times mr-1"></i> Chờ xác nhận</span>
                            @elseif($order->status === 'confirmed')
                                <span class="text-green-600 font-bold flex items-center"><i class="fas fa-check mr-1"></i> Đã xác nhận</span>
                            @elseif($order->status === 'rejected')
                                <span class="text-red-600 font-bold flex items-center"><i class="fas fa-times mr-1"></i> Đã từ chối</span>
                            @else
                                <span class="text-gray-400 font-bold flex items-center">{{ $order->status }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.user.user_order', $order->id) }}" class="text-blue-600 hover:underline">Xem chi tiết</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Người dùng này chưa có đơn hàng nào.</p>
            @endif
        </div>
        <a href="{{ route('admin.users') }}" class="inline-block mt-6 text-primary hover:underline">&larr; Quay lại danh sách tài khoản</a>
    </main>
</div>
@endsection
