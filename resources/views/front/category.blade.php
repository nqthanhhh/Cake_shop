<!-- filepath: c:\project-webnc\shop1\Cake_Shop\resources\views\front\category.blade.php -->
@extends('front.layout.master')

@section('title', $category->name)

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-8">{{ $category->name }}</h1>
        <p class="text-gray-600 mb-12">{{ $category->description }}</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
    @foreach($products as $product)
    <div class="product-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300">
        <div class="h-100 w-full overflow-hidden">
            <img
                src="{{ asset($product->image) }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-cover object-top"
            />
            <a href="{{ route('product', $product->id) }}" class="view-details-btn">
            Xem chi tiết
            </a>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-bold mb-2">{{ $product->name }}</h3>
            <p class="text-gray-600 mb-4">
                {{ $product->description }}
            </p>
            <div class="flex justify-between items-center">
                <span class="text-primary font-bold text-xl">{{ number_format($product->price) }}đ</span>
                <button
                    class="add-to-cart bg-primary text-white px-4 py-2 rounded-button hover:bg-opacity-90 transition-colors whitespace-nowrap"
                    data-product-id="{{ $product->id }}"
                    data-product-name="{{ $product->name }}"
                    data-product-price="{{ $product->price }}"
                    data-product-image="{{ $product->image }}"
                >
                    Thêm vào giỏ
                </button>
            </div>
        </div>
    </div>
    @endforeach
        </div>
    </div>
</section>
@endsection
