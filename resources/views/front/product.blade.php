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
                    @if($product->reviews && $product->reviews->count() > 0)
                        @php
                            $averageRating = $product->reviews->avg('rating');
                            $reviewCount = $product->reviews->count();
                            $fullStars = floor($averageRating);
                            $hasHalfStar = ($averageRating - $fullStars) >= 0.5;
                        @endphp
                        <div class="flex text-yellow-500">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $fullStars)
                                    <i class="ri-star-fill"></i>
                                @elseif($i == $fullStars + 1 && $hasHalfStar)
                                    <i class="ri-star-half-fill"></i>
                                @else
                                    <i class="ri-star-line text-gray-300"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="ml-2 text-gray-500">
                            ({{ number_format($averageRating, 1) }}/5 • {{ $reviewCount }} đánh giá)
                        </span>
                    @else
                        <div class="flex text-gray-300">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="ri-star-line"></i>
                            @endfor
                        </div>
                        <span class="ml-2 text-gray-500">(Chưa có đánh giá)</span>
                    @endif
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

        <!-- Đánh giá sản phẩm -->
        <div class="mt-12 bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Đánh giá sản phẩm</h2>

            @auth
            <!-- Form gửi đánh giá -->
            <div class="bg-gradient-to-r from-primary/5 to-primary/10 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-bold mb-4 text-gray-800 flex items-center">
                    <i class="ri-edit-box-line mr-2 text-primary"></i>
                    Chia sẻ đánh giá của bạn
                </h3>
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="rating" id="selected-rating" value="">

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-3">
                            <i class="ri-star-line mr-1"></i>
                            Đánh giá của bạn
                        </label>
                        <div class="flex items-center space-x-1 mb-2">
                            <div class="star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="ri-star-line text-3xl cursor-pointer transition-colors duration-200 hover:text-yellow-400"
                                       data-rating="{{ $i }}"
                                       id="star-{{ $i }}"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="text-sm text-gray-500" id="rating-text">Nhấp vào sao để đánh giá</p>
                    </div>

                    <div class="mb-6">
                        <label for="comment" class="block text-gray-700 font-medium mb-2">
                            <i class="ri-message-3-line mr-1"></i>
                            Nhận xét của bạn
                        </label>
                        <textarea name="comment" id="comment" rows="4" required
                            placeholder="Chia sẻ trải nghiệm của bạn về sản phẩm này..."
                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary resize-none"></textarea>
                    </div>

                    <div>
                        <button type="submit" id="submit-review" disabled class="bg-gray-400 text-white px-8 py-3 rounded-lg transition-all flex items-center space-x-2 cursor-not-allowed">
                            <i class="ri-send-plane-line"></i>
                            <span>Gửi đánh giá</span>
                        </button>
                    </div>
                </form>
            </div>
            @else
            <p class="text-gray-600">Vui lòng <a href="{{ route('login') }}" class="text-primary hover:underline">đăng nhập</a> để để lại đánh giá.</p>
            @endauth

            <!-- Hiển thị đánh giá -->
            <div class="mt-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Đánh giá từ khách hàng</h3>
                    @if ($product->reviews && $product->reviews->count() > 0)
                        <span class="bg-primary text-white px-3 py-1 rounded-full text-sm">
                            {{ $product->reviews->count() }} đánh giá
                        </span>
                    @endif
                </div>

                @if ($product->reviews && $product->reviews->count() > 0)
                    <div class="space-y-6">
                        @foreach ($product->reviews as $review)
                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center font-bold">
                                            {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $review->user->name }}</p>
                                            <div class="flex text-yellow-500 text-sm">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                        <i class="ri-star-fill"></i>
                                                    @else
                                                        <i class="ri-star-line text-gray-300"></i>
                                                    @endif
                                                @endfor
                                                <span class="ml-2 text-gray-500">({{ $review->rating }}/5)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-sm text-gray-400">{{ $review->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="pl-13">
                                    <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="mb-4">
                            <i class="ri-chat-3-line text-4xl text-gray-400"></i>
                        </div>
                        <p class="text-gray-600 text-lg mb-2">Chưa có đánh giá nào</p>
                        <p class="text-gray-500">Hãy trở thành người đầu tiên đánh giá sản phẩm này!</p>
                    </div>
                @endif
            </div>
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

        // Star Rating System
        const stars = document.querySelectorAll('.star-rating i');
        const selectedRating = document.getElementById('selected-rating');
        const ratingText = document.getElementById('rating-text');
        const submitButton = document.getElementById('submit-review');

        const ratingTexts = {
            1: 'Rất kém',
            2: 'Kém',
            3: 'Ổn',
            4: 'Tốt',
            5: 'Tuyệt vời'
        };

        stars.forEach((star, index) => {
            // Hover effect
            star.addEventListener('mouseenter', function() {
                const rating = parseInt(this.dataset.rating);
                highlightStars(rating);
            });

            // Click to select
            star.addEventListener('click', function() {
                const rating = parseInt(this.dataset.rating);
                selectedRating.value = rating;
                ratingText.textContent = `${rating} sao - ${ratingTexts[rating]}`;
                ratingText.className = 'text-sm text-yellow-600 font-medium';

                // Enable submit button
                submitButton.disabled = false;
                submitButton.className = 'bg-primary text-white px-8 py-3 rounded-lg hover:bg-opacity-90 transition-all transform hover:scale-105 flex items-center space-x-2 cursor-pointer';

                // Keep stars highlighted
                highlightStars(rating);
            });
        });

        // Reset on mouse leave
        document.querySelector('.star-rating').addEventListener('mouseleave', function() {
            const currentRating = parseInt(selectedRating.value) || 0;
            highlightStars(currentRating);
        });

        function highlightStars(rating) {
            stars.forEach((star, index) => {
                const starNumber = index + 1;
                if (starNumber <= rating) {
                    star.className = 'ri-star-fill text-3xl cursor-pointer text-yellow-400';
                } else {
                    star.className = 'ri-star-line text-3xl cursor-pointer transition-colors duration-200 hover:text-yellow-400 text-gray-300';
                }
            });
        }
    });
</script>
@endpush
