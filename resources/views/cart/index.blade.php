@extends('front.layout.master')

@section('title', 'Giỏ hàng - Sweet Cake')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Giỏ hàng của bạn</h1>

    @if(empty($cart))
        <div class="text-center py-16">
            <div class="text-6xl text-gray-300 mb-4">
                <i class="ri-shopping-cart-line"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-4">Giỏ hàng của bạn đang trống</h3>
            <p class="text-gray-500 mb-6">Hãy thêm một số sản phẩm vào giỏ hàng của bạn!</p>
            <a href="{{ route('home') }}" class="bg-primary text-white px-6 py-3 rounded-button hover:bg-opacity-90 transition-colors">
                Tiếp tục mua sắm
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-4">Sản phẩm trong giỏ hàng</h2>

                        @foreach($cart as $item)
                        <div class="flex items-center py-4 border-b border-gray-200 cart-item" data-product-id="{{ $item['id'] }}">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-20 h-20 object-cover rounded-lg">

                            <div class="flex-1 ml-4">
                                <h3 class="font-semibold text-lg">{{ $item['name'] }}</h3>
                                <p class="text-primary font-bold">{{ number_format($item['price']) }}đ</p>
                            </div>

                            <div class="flex items-center space-x-3">
                                <button class="quantity-btn bg-gray-200 hover:bg-gray-300 w-8 h-8 rounded-full flex items-center justify-center"
                                        onclick="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] - 1 }})">
                                    <i class="ri-subtract-line"></i>
                                </button>

                                <span class="quantity-display font-semibold px-3">{{ $item['quantity'] }}</span>

                                <button class="quantity-btn bg-gray-200 hover:bg-gray-300 w-8 h-8 rounded-full flex items-center justify-center"
                                        onclick="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] + 1 }})">
                                    <i class="ri-add-line"></i>
                                </button>

                                <button class="text-red-500 hover:text-red-700 ml-4"
                                        onclick="removeFromCart({{ $item['id'] }})">
                                    <i class="ri-delete-bin-line text-xl"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-semibold mb-4">Tóm tắt đơn hàng</h2>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between">
                            <span>Tạm tính:</span>
                            <span id="subtotal">{{ number_format($total) }}đ</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Phí vận chuyển:</span>
                            <span>Miễn phí</span>
                        </div>
                        <hr>
                        <div class="flex justify-between font-bold text-lg">
                            <span>Tổng cộng:</span>
                            <span id="total" class="text-primary">{{ number_format($total) }}đ</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout') }}" class="w-full bg-primary text-white py-3 rounded-button font-semibold hover:bg-opacity-90 transition-colors block text-center">
                        Thanh toán
                    </a>

                    <a href="{{ route('home') }}" class="block text-center text-primary hover:underline mt-4">
                        Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
function updateQuantity(productId, newQuantity) {
    if (newQuantity < 1) {
        removeFromCart(productId);
        return;
    }

    fetch('/cart/update', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Reload để cập nhật giá
        }
    });
}

function removeFromCart(productId) {
    if (confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
        fetch(`/cart/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}
</script>
@endsection
