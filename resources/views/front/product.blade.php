{{-- filepath: c:\project-webnc\shop1\Cake_Shop\resources\views\front\product.blade.php --}}
@extends('front.layout.master')

@section('title', $product->name)

@section('content')
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-12">
            <!-- Hình ảnh sản phẩm -->
            <div class="md:w-1/2">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-lg">
            </div>
            <!-- Thông tin sản phẩm -->
            <div class="md:w-1/2">
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
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
                <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                <p class="text-primary font-bold text-2xl mb-6">{{ number_format($product->price) }}đ</p>
                <!-- Nút thêm vào giỏ -->
                <button
                    class="add-to-cart bg-primary text-white px-6 py-3 rounded-button hover:bg-opacity-90 transition-colors"
                    data-product-id="{{ $product->id }}"
                    data-product-name="{{ $product->name }}"
                    data-product-price="{{ $product->price }}"
                    data-product-image="{{ $product->image }}"
                >
                    Thêm vào giỏ
                </button>
                <!-- Nút chia sẻ -->
                <div class="mt-6">
                    <h4 class="text-lg font-bold mb-2">Chia sẻ:</h4>
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
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-4">Chi tiết sản phẩm</h2>
            <p class="text-gray-600 leading-relaxed">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
        </div>
    </div>
</section>
@endsection
