{{-- filepath: c:\project-webnc\shop1\Cake_Shop\resources\views\front\product.blade.php --}}
@extends('front.layout.master')

@section('title', $product->name)

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-12 bg-white p-8 rounded-lg shadow-lg">
            <!-- Hình ảnh sản phẩm -->
            <div class="md:w-1/2">
                <div class="relative">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-md">
                    <span class="absolute top-4 left-4 bg-primary text-white text-sm px-3 py-1 rounded-full">
                        Mới
                    </span>
                </div>
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="md:w-1/2">
                <h1 class="text-4xl font-bold mb-4 text-gray-800">{{ $product->name }}</h1>
                <div class="flex items-center mb-4">
                    <!-- Đánh giá sao -->
                    <div class="flex text-yellow-500">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                    </div>
                    <span class="ml-2 text-gray-500">(120 đánh giá)</span>
                </div>
                <p class="text-gray-600 mb-4 leading-relaxed">{{ $product->description }}</p>
                <p class="text-primary font-bold text-3xl mb-6">{{ number_format($product->price) }}đ</p>

                <!-- Số lượng và nút thêm vào giỏ -->
                <div class="flex items-end gap-4 mb-6">
                    <div>
                        <label for="quantity" class="block text-gray-600 font-medium mb-1">Số lượng:</label>
                        <div class="flex items-center">
                            <button type="button" id="decrement-button" class="px-3 py-2 border border-r-0 border-gray-300 rounded-l-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">-</button>
                            <input
                                type="number"
                                id="quantity"
                                name="quantity"
                                value="1"
                                min="1"
                                class="w-16 text-center border-t border-b border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-primary"
                            >
                            <button type="button" id="increment-button" class="px-3 py-2 border border-l-0 border-gray-300 rounded-r-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">+</button>
                        </div>
                    </div>
                    <button
                        class="add-to-cart bg-primary text-white px-6 py-3 rounded-lg hover:bg-opacity-90 transition-all"
                        data-product-id="{{ $product->id }}"
                        data-product-name="{{ $product->name }}"
                        data-product-price="{{ $product->price }}"
                        data-product-image="{{ $product->image }}"
                    >
                        Thêm vào giỏ
                    </button>
                </div>

                <!-- Nút chia sẻ -->
                <div class="mt-6">
                    <h4 class="text-lg font-bold mb-2 text-gray-800">Chia sẻ:</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-primary">
                            <i class="ri-facebook-fill text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary">
                            <i class="ri-instagram-line text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary">
                            <i class="ri-twitter-line text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thông tin chi tiết sản phẩm -->
        <div class="mt-12 bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Mô tả</h2>
            <p class="text-gray-600 leading-relaxed">
                {{ $product->detailed_description }} <br>

                Mặc định size bánh là 6 inch, nếu bạn muốn đặt size khác thì vui lòng liên hệ với chúng tôi qua số điện thoại hoặc email.
            </p>
        </div>
<!-- Danh mục liên quan -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-4">Danh mục liên quan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($categories as $category)
                <a href="{{ route('category.show', $category->slug) }}" class="block bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="w-full h-100 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold">{{ $category->name }}</h3>
                        <p class="text-gray-600">{{ $category->description }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInput = document.getElementById('quantity');
        const incrementButton = document.getElementById('increment-button');
        const decrementButton = document.getElementById('decrement-button');

        incrementButton.addEventListener('click', function () {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });

        decrementButton.addEventListener('click', function () {
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
    });
</script>
@endpush
