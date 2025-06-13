@extends('front.layout.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <!-- Thông tin người dùng -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Thông tin cá nhân</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-600 mb-2">Họ và tên:</p>
                    <p class="font-medium">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-gray-600 mb-2">Email:</p>
                    <p class="font-medium">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-gray-600 mb-2">Số điện thoại:</p>
                    <p class="font-medium">{{ $user->phone ?? 'Chưa cập nhật' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 mb-2">Địa chỉ:</p>
                    <p class="font-medium">{{ $user->address ?? 'Chưa cập nhật' }}</p>
                </div>
            </div>
            <button onclick="window.location.href='{{ route('profile.edit') }}'"
                    class="mt-4 bg-primary text-white px-4 py-2 rounded-button hover:bg-opacity-90">
                Cập nhật thông tin
            </button>
        </div>

        <!-- Lịch sử đơn hàng -->
        <div>
            <h2 class="text-2xl font-bold mb-4">Lịch sử đơn hàng</h2>
            @if($orders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left">Mã đơn hàng</th>
                                <th class="px-4 py-2 text-left">Ngày đặt</th>
                                <th class="px-4 py-2 text-left">Tổng tiền</th>
                                <th class="px-4 py-2 text-left">Trạng thái</th>
                                <th class="px-4 py-2 text-left">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr class="border-b">
                                <td class="px-4 py-2">#{{ $order->id }}</td>
                                <td class="px-4 py-2">{{ $order->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">{{ number_format($order->total) }}đ</td>
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 rounded-full text-sm
                                        @if($order->status === 'completed') bg-green-100 text-green-800
                                        @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    <a href="#" class="text-primary hover:underline">Chi tiết</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500">Bạn chưa có đơn hàng nào</p>
            @endif
        </div>
    </div>
</div>
@endsection
