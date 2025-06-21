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
                @php
                    $selected = request('selected_products');
                    if (!is_array($selected)) {
                        $selected = $selected ? explode(',', $selected) : [];
                    }
                @endphp
                @foreach($selected as $pid)
                    <input type="hidden" name="selected_products[]" value="{{ $pid }}">
                @endforeach

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
                    <label for="province" class="block text-sm font-medium text-gray-700 mb-2">Tỉnh/Thành phố *</label>
                    <select id="province" name="province" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">Chọn tỉnh/thành phố</option>
                        <!-- Options sẽ được thêm bởi JavaScript -->
                    </select>
                </div>

                <div>
                    <label for="district" class="block text-sm font-medium text-gray-700 mb-2">Quận/Huyện *</label>
                    <select id="district" name="district" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">Chọn quận/huyện</option>
                        <!-- Options sẽ được thêm bởi JavaScript -->
                    </select>
                </div>

                <div>
                    <label for="ward" class="block text-sm font-medium text-gray-700 mb-2">Phường/Xã *</label>
                    <select id="ward" name="ward" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">Chọn phường/xã</option>
                        <!-- Options sẽ được thêm bởi JavaScript -->
                    </select>
                </div>

                <div>
                    <label for="specific_address" class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ cụ thể *</label>
                    <input type="text" id="specific_address" name="specific_address" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>

                <div>
                    <label for="delivery_datetime" class="block text-sm font-medium text-gray-700 mb-2">Ngày và thời gian muốn nhận hàng *</label>
                    <div class="grid grid-cols-3 gap-4">
                        <input type="date" id="delivery_date" name="delivery_date"
                               value="{{ old('delivery_date', date('Y-m-d', strtotime('+1 day'))) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">

                        <select id="delivery_hour" name="delivery_hour" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ old('delivery_hour') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>

                        <select id="delivery_minute" name="delivery_minute" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                            @for ($i = 0; $i < 60; $i++)
                                <option value="{{ $i }}" {{ old('delivery_minute') == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>

                        <select id="delivery_ampm" name="delivery_ampm" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="AM" {{ old('delivery_ampm') == 'AM' ? 'selected' : '' }}>AM</option>
                            <option value="PM" {{ old('delivery_ampm') == 'PM' ? 'selected' : '' }}>PM</option>
                        </select>
                    </div>
                    <input type="hidden" name="delivery_time" value="{{ old('delivery_hour') }}:{{ old('delivery_minute') }} {{ old('delivery_ampm') }}">

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
                @foreach ($cart as $item)
    <div class="cart-item flex items-center justify-between py-4 border-b border-gray-200">
        <div class="flex items-center">
            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded-lg">
            <div class="ml-4">
                <h3 class="text-lg font-semibold">{{ $item->product->name }}</h3>
                <p class="text-gray-500">Số lượng: {{ $item->quantity }}</p>
            </div>
        </div>
        <p class="text-lg font-semibold">{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} đ</p>
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
}

// Set default selection on page load
document.addEventListener('DOMContentLoaded', function() {
    const checkedMethod = document.querySelector('input[name="payment_method"]:checked');
    if (checkedMethod) {
        selectPaymentMethod(checkedMethod.value);
    }

    const provinceSelect = document.getElementById('province');
    const districtSelect = document.getElementById('district');
    const wardSelect = document.getElementById('ward');

    // Kiểm tra nếu các phần tử dropdown tồn tại
    if (!provinceSelect || !districtSelect || !wardSelect) {
        console.error('Không tìm thấy các phần tử dropdown!');
        return;
    }

    // Fetch dữ liệu từ file JSON
    fetch('/locations.json')
        .then(response => response.json())
        .then(data => {
            // Điền danh sách tỉnh/thành phố
            Object.keys(data).forEach(province => {
                const option = document.createElement('option');
                option.value = province;
                option.textContent = province;
                provinceSelect.appendChild(option);
            });

            provinceSelect.addEventListener('change', function() {
                const selectedProvince = this.value;
                districtSelect.innerHTML = '<option value="">Chọn quận/huyện</option>';
                wardSelect.innerHTML = '<option value="">Chọn phường/xã</option>';

                if (data[selectedProvince]) {
                    Object.keys(data[selectedProvince]).forEach(district => {
                        const option = document.createElement('option');
                        option.value = district;
                        option.textContent = district;
                        districtSelect.appendChild(option);
                    });
                } else {
                    console.warn('Không có dữ liệu quận/huyện cho tỉnh/thành phố này:', selectedProvince);
                }
            });

            districtSelect.addEventListener('change', function() {
                const selectedProvince = provinceSelect.value;
                const selectedDistrict = this.value;
                wardSelect.innerHTML = '<option value="">Chọn phường/xã</option>';

                if (data[selectedProvince] && data[selectedProvince][selectedDistrict]) {
                    data[selectedProvince][selectedDistrict].forEach(ward => {
                        const option = document.createElement('option');
                        option.value = ward;
                        option.textContent = ward;
                        wardSelect.appendChild(option);
                    });
                } else {
                    console.warn('Không có dữ liệu phường/xã cho quận/huyện này:', selectedDistrict);
                }
            });
        })
        .catch(error => console.error('Lỗi khi tải dữ liệu địa phương:', error));
});
</script>
@endsection
