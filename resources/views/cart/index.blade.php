@extends('front.layout.master')

@section('title', 'Giỏ hàng - Sweet Cake')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Giỏ hàng của bạn</h1>

    @if(empty($total))
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
                        <form id="cartForm">
                            <div class="flex items-center mb-4">
                                <input type="checkbox" id="selectAll" class="mr-2">
                                <label for="selectAll" class="font-medium">Chọn tất cả</label>
                            </div>
                            @foreach($cart as $item)
                            <div class="cart-item flex items-center justify-between py-4 border-b border-gray-200">
                                <div class="flex items-center">
                                    <input type="checkbox" name="selected_products[]" value="{{ $item->product->id }}" class="select-item mr-4">
                                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded-lg">
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-lg">{{ $item->product->name }}</h3>
                                        <p class="text-gray-500">{{ number_format($item->product->price) }}đ</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <button class="quantity-btn bg-gray-200 hover:bg-gray-300 w-8 h-8 rounded-full flex items-center justify-center"
                                            onclick="updateQuantity({{ $item->product->id }}, {{ $item->quantity - 1 }})" type="button">
                                        <i class="ri-subtract-line"></i>
                                    </button>
                                    <span class="quantity-display font-semibold" data-id="{{ $item->product->id }}">{{ $item->quantity }}</span>
                                    <button class="quantity-btn bg-gray-200 hover:bg-gray-300 w-8 h-8 rounded-full flex items-center justify-center"
                                            onclick="updateQuantity({{ $item->product->id }}, {{ $item->quantity + 1 }})" type="button">
                                        <i class="ri-add-line"></i>
                                    </button>
                                    <p class="font-semibold text-primary">{{ number_format($item->product->price * $item->quantity) }}đ</p>
                                    <button class="remove-item text-red-500 hover:text-red-700"
                                            onclick="removeFromCart({{ $item->product->id }})" type="button">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                            <div class="flex justify-between mt-6">
                                <button type="button" id="deleteSelected" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                    Xóa sản phẩm đã chọn
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-semibold mb-4">Tóm tắt đơn hàng</h2>
                    <div class="space-y-3 mb-4" id="order-summary">
                        <div class="flex justify-between">
                            <span>Tạm tính:</span>
                            <span id="subtotal">0đ</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Phí vận chuyển:</span>
                            <span>Miễn phí</span>
                        </div>
                        <hr>
                        <div class="flex justify-between font-bold text-lg">
                            <span>Tổng cộng:</span>
                            <span id="total" class="text-primary">0đ</span>
                        </div>
                    </div>
                    <form id="checkoutForm" method="GET" action="/checkout">
                        <div id="selectedProductsInputs"></div>
                        <button type="submit" id="checkoutBtn" class="w-full bg-primary text-white py-3 rounded-button font-semibold hover:bg-opacity-90 transition-colors block text-center mt-4" disabled>Thanh toán</button>
                    </form>
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
function formatCurrency(amount) {
    return amount.toLocaleString('vi-VN') + 'đ';
}
function updateOrderSummary() {
    let subtotal = 0;
    let selected = [];
    document.querySelectorAll('.select-item:checked').forEach(cb => {
        const item = cb.closest('.cart-item');
        const priceText = item.querySelector('.font-semibold.text-primary').textContent.replace(/\D/g, '');
        subtotal += parseInt(priceText) || 0;
        selected.push(cb.value);
    });
    document.getElementById('subtotal').textContent = subtotal > 0 ? formatCurrency(subtotal) : '0đ';
    document.getElementById('total').textContent = subtotal > 0 ? formatCurrency(subtotal) : '0đ';
    // Tạo input hidden dạng mảng
    const inputsDiv = document.getElementById('selectedProductsInputs');
    inputsDiv.innerHTML = '';
    selected.forEach(val => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'selected_products[]';
        input.value = val;
        inputsDiv.appendChild(input);
    });
    document.getElementById('checkoutBtn').disabled = selected.length === 0;
}
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

document.getElementById('deleteSelected').addEventListener('click', function() {
    const checked = Array.from(document.querySelectorAll('.select-item:checked')).map(cb => cb.value);
    if (checked.length === 0) {
        alert('Vui lòng chọn sản phẩm để xóa!');
        return;
    }
    if (!confirm('Bạn có chắc chắn muốn xóa các sản phẩm đã chọn?')) return;
    fetch('/cart/delete-multiple', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ product_ids: checked })
    })
    .then(res => res.json())
    .then(data => location.reload());
});

document.querySelectorAll('.select-item').forEach(cb => {
    cb.addEventListener('change', updateOrderSummary);
});
document.getElementById('selectAll').addEventListener('change', function() {
    document.querySelectorAll('.select-item').forEach(cb => cb.checked = this.checked);
    updateOrderSummary();
});
window.addEventListener('DOMContentLoaded', updateOrderSummary);
</script>
@endsection
