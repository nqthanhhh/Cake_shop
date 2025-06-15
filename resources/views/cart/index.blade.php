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
<div class="cart-item flex items-center justify-between py-4 border-b border-gray-200">
    <div class="flex items-center">
        <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded-lg">
        <div class="ml-4">
            <h3 class="font-semibold text-lg">{{ $item->product->name }}</h3>
            <p class="text-gray-500">{{ number_format($item->product->price) }}đ</p>
        </div>
    </div>
    <div class="flex items-center space-x-4">
        <button class="quantity-btn bg-gray-200 hover:bg-gray-300 w-8 h-8 rounded-full flex items-center justify-center"
                onclick="updateQuantity({{ $item->product->id }}, {{ $item->quantity - 1 }})">
            <i class="ri-subtract-line"></i>
        </button>
        <span class="quantity-display font-semibold" data-id="{{ $item->product->id }}">{{ $item->quantity }}</span>
        <button class="quantity-btn bg-gray-200 hover:bg-gray-300 w-8 h-8 rounded-full flex items-center justify-center"
                onclick="updateQuantity({{ $item->product->id }}, {{ $item->quantity + 1 }})">
            <i class="ri-add-line"></i>
        </button>
        <p class="font-semibold text-primary">{{ number_format($item->product->price * $item->quantity) }}đ</p>
        <button class="remove-item text-red-500 hover:text-red-700"
                onclick="removeFromCart({{ $item->product->id }})">
            <i class="ri-delete-bin-line"></i>
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
            <div id="confirmDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-4">Xác nhận xóa sản phẩm</h3>
        <p class="text-gray-600 mb-6">Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?</p>
        <div class="flex justify-end space-x-4">
            <button id="cancelDelete" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
                Hủy
            </button>
            <button id="confirmDelete" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Xóa
            </button>
        </div>
    </div>
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
let productIdToDelete = null;

function removeFromCart(productId) {
    // Hiển thị modal xác nhận
    const modal = document.getElementById('confirmDeleteModal');
    const cancelBtn = document.getElementById('cancelDelete');
    const confirmBtn = document.getElementById('confirmDelete');

    productIdToDelete = productId; // Lưu lại ID sản phẩm cần xóa
    modal.classList.remove('hidden'); // Hiển thị modal

    // Hủy xóa
    cancelBtn.onclick = function () {
        modal.classList.add('hidden'); // Ẩn modal
        productIdToDelete = null; // Xóa ID sản phẩm cần xóa
    };

    // Xác nhận xóa
    confirmBtn.onclick = function () {
        modal.classList.add('hidden'); // Ẩn modal

        // Gửi yêu cầu xóa sản phẩm
        fetch(`/cart/${productIdToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Tải lại trang để cập nhật giỏ hàng
            } else {
                alert('Có lỗi xảy ra. Vui lòng thử lại!');
            }
        })
        .catch(error => {
            console.error('Lỗi:', error);
            alert('Không thể xóa sản phẩm. Vui lòng thử lại!');
        });
    };
}
</script>
@endsection
