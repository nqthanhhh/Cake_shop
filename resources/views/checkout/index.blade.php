{{-- filepath: c:\project-webnc\shop1\Cake_Shop\resources\views\checkout\index.blade.php --}}
@extends('front.layout.master')

@section('title', 'Thanh toán - Sweet Cake')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Thanh toán đơn hàng</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Form thông tin -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-6">Thông tin giao hàng</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('order.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">Họ và tên *</label>
                    <input type="text" id="customer_name" name="customer_name"
                           value="{{ old('customer_name', $user->name) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>

                <div>
                    <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" id="customer_email" name="customer_email"
                           value="{{ old('customer_email', $user->email) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>

                <div>
                    <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại *</label>
                    <input type="tel" id="customer_phone" name="customer_phone"
                           value="{{ old('customer_phone', $user->phone) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>

                <div>
                    <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ giao hàng *</label>
                    <textarea id="customer_address" name="customer_address" rows="3" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">{{ old('customer_address', $user->address) }}</textarea>
                </div>

                <div>
                    <label for="delivery_date" class="block text-sm font-medium text-gray-700 mb-2">Ngày giao hàng *</label>
                    <input type="date" id="delivery_date" name="delivery_date"
                           value="{{ old('delivery_date') }}" required min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Ghi chú</label>
                    <textarea id="notes" name="notes" rows="3" placeholder="Ghi chú thêm về đơn hàng..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">{{ old('notes') }}</textarea>
                </div>
                <!-- Phương thức thanh toán -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-4">Phương thức thanh toán *</label>
                    <div class="space-y-3">
                        <!-- COD -->
                        <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-primary cursor-pointer payment-method" onclick="selectPaymentMethod('cod')">
                            <input type="radio" id="cod" name="payment_method" value="cod"
                                   {{ old('payment_method', 'cod') == 'cod' ? 'checked' : '' }}
                                   class="w-4 h-4 text-primary bg-gray-100 border-gray-300">
                            <label for="cod" class="ml-3 cursor-pointer flex-1">
                                <div class="flex items-center">
                                    <i class="ri-truck-line text-xl text-primary mr-3"></i>
                                    <div>
                                        <p class="font-medium">Thanh toán khi nhận hàng (COD)</p>
                                        <p class="text-sm text-gray-500">Thanh toán bằng tiền mặt khi nhận bánh</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <!-- Bank Transfer -->
                        <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-primary cursor-pointer payment-method" onclick="selectPaymentMethod('bank_transfer')">
                            <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer"
                                   {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}
                                   class="w-4 h-4 text-primary bg-gray-100 border-gray-300">
                            <label for="bank_transfer" class="ml-3 cursor-pointer flex-1">
                                <div class="flex items-center">
                                    <i class="ri-bank-line text-xl text-primary mr-3"></i>
                                    <div>
                                        <p class="font-medium">Chuyển khoản ngân hàng</p>
                                        <p class="text-sm text-gray-500">Chuyển khoản trước khi giao hàng</p>
                                    </div>
                                </div>
                            </label>
                        </div>

                    </div>
                </div>
                <!-- Thông tin chuyển khoản (hiển thị khi chọn bank transfer) -->
                <div id="bank_info" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h4 class="font-semibold text-blue-800 mb-3">Thông tin chuyển khoản:</h4>
                    <div class="space-y-2 text-sm">
                        <p><strong>Ngân hàng:</strong> Vietcombank</p>
                        <p><strong>Số tài khoản:</strong> 1234567890</p>
                        <p><strong>Chủ tài khoản:</strong> Sweet Cake Shop</p>
                        <p><strong>Nội dung CK:</strong> <span class="font-mono bg-white px-2 py-1 rounded">Thanh toan don hang [Mã đơn hàng]</span></p>
                        <p class="text-blue-600"><i class="ri-information-line"></i> Vui lòng chuyển khoản đúng số tiền và nội dung để được xử lý nhanh chóng</p>
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-3 rounded-md font-semibold hover:bg-opacity-90 transition-colors">
                    Đặt hàng
                </button>
            </form>
        </div>

        <!-- Thông tin đơn hàng -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-6">Chi tiết đơn hàng</h2>

            <div class="space-y-4 mb-6">
                @foreach($cart as $item)
                <div class="flex items-center justify-between py-3 border-b border-gray-200">
                    <div class="flex items-center">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded-lg mr-4">
                        <div>
                            <h3 class="font-medium">{{ $item['name'] }}</h3>
                            <p class="text-sm text-gray-600">{{ number_format($item['price']) }}đ x {{ $item['quantity'] }}</p>
                        </div>
                    </div>
                    <p class="font-semibold">{{ number_format($item['price'] * $item['quantity']) }}đ</p>
                </div>
                @endforeach
            </div>

            <div class="border-t pt-4 space-y-2">
                <div class="flex justify-between">
                    <span>Tạm tính:</span>
                    <span>{{ number_format($total) }}đ</span>
                </div>
                <div class="flex justify-between">
                    <span>Phí vận chuyển:</span>
                    <span>Miễn phí</span>
                </div>
                <div class="flex justify-between font-bold text-lg border-t pt-2">
                    <span>Tổng cộng:</span>
                    <span class="text-primary">{{ number_format($total) }}đ</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function selectPaymentMethod(method) {
    // Reset all borders
    document.querySelectorAll('.payment-method').forEach(el => {
        el.classList.remove('border-primary', 'bg-blue-50');
        el.classList.add('border-gray-200');
    });

    // Highlight selected method
    const selectedMethod = document.querySelector(`#${method}`).closest('.payment-method');
    selectedMethod.classList.remove('border-gray-200');
    selectedMethod.classList.add('border-primary', 'bg-blue-50');

    // Check radio button
    document.querySelector(`#${method}`).checked = true;

    // Show/hide bank info
    const bankInfo = document.getElementById('bank_info');
    const btnText = document.getElementById('btn_text');

    if (method === 'bank_transfer') {
        bankInfo.classList.remove('hidden');
        btnText.textContent = 'Đặt hàng & Xem thông tin CK';
    } else {
        bankInfo.classList.add('hidden');
        if (method === 'cod') {
            btnText.textContent = 'Đặt hàng (COD)';
        } else if (method === 'momo') {
            btnText.textContent = 'Đặt hàng & Thanh toán MoMo';
        } else if (method === 'vnpay') {
            btnText.textContent = 'Đặt hàng & Thanh toán VNPay';
        }
    }
}

// Set default selection on page load
document.addEventListener('DOMContentLoaded', function() {
    const checkedMethod = document.querySelector('input[name="payment_method"]:checked');
    if (checkedMethod) {
        selectPaymentMethod(checkedMethod.value);
    }
});
</script>
@endsection
