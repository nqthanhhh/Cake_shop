@extends('front.layout.master')
@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-t-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Chi tiết đơn hàng</h1>
                    <p class="text-pink-100">Mã đơn hàng: #{{ $order->id }}</p>
                </div>
                <div class="text-right">
                    <i class="fas fa-receipt text-4xl opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Order Info -->
        <div class="bg-white shadow-lg rounded-b-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-calendar-alt text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Ngày đặt hàng</p>
                            <p class="font-semibold text-gray-800">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="bg-orange-100 p-3 rounded-full mr-4">
                            <i class="fas fa-truck text-orange-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Dự kiến giao hàng</p>
                            <p class="font-semibold text-gray-800">
                                {{ $order->delivery_date ? $order->delivery_date->format('d/m/Y') : 'Chưa xác định' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <i class="fas fa-info-circle text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Trạng thái đơn hàng</p>
                            <p class="font-semibold">
                                @if($order->status === 'pending')
                                    <span class="text-yellow-600">Chờ xác nhận</span>
                                @elseif($order->status === 'confirmed')
                                    <span class="text-green-600">Đã xác nhận</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="text-red-600">Đã hủy</span>
                                @else
                                    <span class="text-gray-600">{{ $order->status }}</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="bg-purple-100 p-3 rounded-full mr-4">
                            <i class="fas fa-money-bill-wave text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tổng tiền</p>
                            <p class="font-bold text-xl text-purple-600">
                                {{ number_format($order->orderItems->sum(fn($item) => $item->product_price * $item->quantity), 0, ',', '.') }}đ
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-yellow-50 to-orange-50">
                <h3 class="text-xl font-semibold mb-4 flex items-center text-gray-800">
                    <i class="fas fa-credit-card mr-2 text-orange-500"></i>
                    Thông tin thanh toán
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-2 rounded-full mr-3">
                            <i class="fas fa-wallet text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Phương thức thanh toán</p>
                            <p class="font-semibold text-gray-800">
                                {{ $order->getPaymentMethodInVietnamese() ?? 'Chưa cập nhật' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="bg-green-100 p-2 rounded-full mr-3">
                            <i class="fas fa-check-circle text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Trạng thái thanh toán</p>
                            <p class="font-semibold">
                                @if($order->payment_status === 'pending')
                                    <span class="text-yellow-600">Chờ thanh toán</span>
                                @elseif($order->payment_status === 'paid')
                                    <span class="text-green-600">Đã thanh toán</span>
                                @elseif($order->payment_status === 'failed')
                                    <span class="text-red-600">Thanh toán thất bại</span>
                                @else
                                    <span class="text-gray-600">{{ $order->payment_status ?? 'Chưa cập nhật' }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <h3 class="text-xl font-semibold mb-4 flex items-center text-gray-800">
                    <i class="fas fa-shipping-fast mr-2 text-indigo-500"></i>
                    Thông tin nhận hàng
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Customer Details -->
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 p-2 rounded-full mr-3">
                                <i class="fas fa-user text-indigo-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tên khách hàng</p>
                                <p class="font-semibold text-gray-800">{{ $order->customer_name ?? 'Chưa cập nhật' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="bg-green-100 p-2 rounded-full mr-3">
                                <i class="fas fa-phone text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Số điện thoại</p>
                                <p class="font-semibold text-gray-800">{{ $order->customer_phone ?? 'Chưa cập nhật' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="bg-yellow-100 p-2 rounded-full mr-3">
                                <i class="fas fa-envelope text-yellow-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-semibold text-gray-800">{{ $order->customer_email ?? 'Chưa cập nhật' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div>
                        <div class="flex items-start">
                            <div class="bg-red-100 p-2 rounded-full mr-3 mt-1">
                                <i class="fas fa-map-marker-alt text-red-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Địa chỉ nhận hàng</p>
                                <div class="bg-white rounded-lg p-3 border border-gray-200 shadow-sm">
                                    <p class="font-semibold text-gray-800 leading-relaxed">
                                        {{ $order->customer_address ?? 'Chưa cập nhật địa chỉ' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if($order->notes)
                        <div class="flex items-start mt-4">
                            <div class="bg-orange-100 p-2 rounded-full mr-3 mt-1">
                                <i class="fas fa-sticky-note text-orange-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 mb-1">Ghi chú</p>
                                <div class="bg-white rounded-lg p-3 border border-gray-200 shadow-sm">
                                    <p class="text-gray-700 italic">{{ $order->notes }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-6 flex items-center">
                    <i class="fas fa-shopping-bag mr-2 text-pink-500"></i>
                    Sản phẩm đã đặt
                </h3>

                <div class="space-y-4">
                    @foreach ($order->orderItems as $item)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center space-x-4">
                            <!-- Product Image -->
                            <div class="flex-shrink-0">
                                <img src="{{ asset($item->product_image) }}"
                                     alt="{{ $item->product_name }}"
                                     class="w-20 h-20 object-cover rounded-lg shadow-sm">
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1 min-w-0">
                                <h4 class="text-lg font-semibold text-gray-800 truncate">
                                    {{ $item->product_name }}
                                </h4>
                                <div class="mt-2 grid grid-cols-1 sm:grid-cols-3 gap-2 text-sm">
                                    <div class="flex items-center">
                                        <span class="text-gray-500">Giá:</span>
                                        <span class="ml-2 font-semibold text-blue-600">
                                            {{ number_format($item->product_price, 0, ',', '.') }}đ
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-gray-500">Số lượng:</span>
                                        <span class="ml-2 font-semibold text-green-600">
                                            {{ $item->quantity }}
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-gray-500">Thành tiền:</span>
                                        <span class="ml-2 font-bold text-purple-600">
                                            {{ number_format($item->product_price * $item->quantity, 0, ',', '.') }}đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Total Summary -->
                <div class="mt-6 bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-4 border-l-4 border-purple-500">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-gray-700">Tổng cộng:</span>
                        <span class="text-2xl font-bold text-purple-600">
                            {{ number_format($order->orderItems->sum(fn($item) => $item->product_price * $item->quantity), 0, ',', '.') }}đ
                        </span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('order.tracking') }}"
                       class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-center hover:from-blue-600 hover:to-blue-700 transition-all transform hover:scale-105 shadow-lg">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Quay lại danh sách đơn hàng
                    </a>

                    @if($order->status === 'pending')
                    <form action="{{ route('order.cancel', $order->id) }}" method="POST" class="flex-1" id="cancelOrderForm">
                        @csrf
                        <button type="button" id="cancelButton"
                                class="w-full bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-red-600 hover:to-red-700 transition-all transform hover:scale-105 shadow-lg">
                            <i class="fas fa-times mr-2"></i>
                            Hủy đơn hàng
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Wait for SweetAlert2 to load
    document.addEventListener('DOMContentLoaded', function() {
        // Check if SweetAlert2 is loaded
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 not loaded');
            return;
        }

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        // Custom confirmation for cancel order
        @if($order->status === 'pending')
            const cancelButton = document.getElementById('cancelButton');
            const cancelForm = document.getElementById('cancelOrderForm');

            if (cancelButton && cancelForm) {
                cancelButton.addEventListener('click', function(e) {
                    e.preventDefault();

                    console.log('Cancel button clicked'); // Debug log

                    // Try SweetAlert2 first
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Xác nhận hủy đơn hàng',
                            text: 'Bạn có chắc chắn muốn hủy đơn hàng này?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Có, hủy đơn hàng',
                            cancelButtonText: 'Không',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            console.log('SweetAlert result:', result); // Debug log
                            if (result.isConfirmed) {
                                console.log('Confirmed, submitting form'); // Debug log
                                cancelForm.submit();
                            } else {
                                console.log('Cancelled'); // Debug log
                            }
                        }).catch((error) => {
                            console.error('SweetAlert error:', error);
                            // Fallback to browser confirm
                            if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
                                cancelForm.submit();
                            }
                        });
                    } else {
                        // Fallback to browser confirm if SweetAlert is not available
                        console.log('SweetAlert not available, using browser confirm');
                        if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
                            cancelForm.submit();
                        }
                    }
                });
            }
        @endif
    });
</script>
@endpush
@endsection
