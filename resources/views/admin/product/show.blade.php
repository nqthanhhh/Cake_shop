@extends('admin.layouts')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/2">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>
            <div class="md:w-1/2 p-8">
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                <div class="mb-4">
                    <span class="text-gray-700 font-semibold">Danh mục:</span>
                    <span class="text-gray-600">{{ $product->category->name }}</span>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 font-semibold">Giá:</span>
                    <span class="text-red-500 font-bold text-xl">{{ number_format($product->price) }}đ</span>
                </div>
                <div class="mb-4">
                    <span class="text-gray-700 font-semibold">Tồn kho:</span>
                    <span class="text-gray-600">{{ $product->stock }}</span>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Mô tả ngắn:</h3>
                    <p class="text-gray-600">{{ $product->description }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Mô tả chi tiết:</h3>
                    <div class="prose max-w-none text-gray-600">{!! $product->detailed_description !!}</div>
                </div>
            </div>
        </div>

        <div class="p-8 border-t border-gray-200">
            <h2 class="text-2xl font-bold mb-4">Đánh giá sản phẩm</h2>
            @if($product->reviews->isNotEmpty())
                <div class="space-y-6">
                    @foreach($product->reviews as $review)
                        <div class="flex items-start space-x-4 border-b py-4">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="{{ asset('img/user.png') }}" alt="">
                            </div>
                            <div class="flex-grow">
                                <div class="flex justify-between items-center">
                                    <div class="font-medium text-gray-900">{{ $review->user->name }}</div>
                                    <form action="{{ route('admin.reviews.delete', $review->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xoá đánh giá này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Xoá đánh giá">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                                <p class="mt-1 text-gray-600">{{ $review->comment }}</p>
                                <p class="mt-1 text-xs text-gray-500">{{ $review->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Chưa có đánh giá nào cho sản phẩm này.</p>
            @endif
        </div>
        <div class="p-8 bg-gray-50 border-t border-gray-200 text-right">
             <a href="{{ route('admin.products') }}" class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Quay lại danh sách
            </a>
        </div>
    </div>
</div>
@endsection
