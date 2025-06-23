@extends('front.layout.master')

@section('title', 'Trang Chủ - Sweet Cake')

@section('content')


    <!-- Hero Section -->
    <section class="hero-section relative">
      <div class="absolute inset-0 bg-black bg-opacity-30"></div>
      <div class="container mx-auto px-4 py-20 md:py-32 relative z-10">
        <div class="max-w-xl">
          <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
            Bánh Kem Tươi Ngon Mỗi Ngày
          </h1>
          <p class="text-lg text-white mb-8">
            Mang đến những chiếc bánh ngọt ngào cho mọi khoảnh khắc đặc biệt của
            bạn
          </p>
            <a href="#products">
              <button
                class="bg-primary text-white px-6 py-3 rounded-button text-lg font-medium hover:bg-opacity-90 transition-colors whitespace-nowrap"
              >
                Đặt hàng ngay
              </button>
            </a>
        </div>
      </div>
    </section>
    <!-- Categories Section -->
    <section class="py-16 bg-gray-50">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Danh Mục Bánh Kem</h2>
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
    </section>
    <!-- Featured Products Section -->
    <section id="products" class="py-20 bg-gradient-to-br from-gray-50 to-white">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-800 mb-4">Sản Phẩm Nổi Bật</h2>
          <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mb-6"></div>
          <p class="text-gray-600 text-lg max-w-3xl mx-auto leading-relaxed">
            Khám phá những chiếc bánh kem được yêu thích nhất tại Sweet Cake, được
            làm từ những nguyên liệu tươi ngon nhất
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
          @foreach($products as $product)
          <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100">
            <!-- Product Image -->
            <div class="relative h-64 w-full overflow-hidden">
              <img
                src="{{ asset($product->image) }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

              <!-- View Details Button -->
              <a href="{{ route('product', $product->id) }}"
                 class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300">
                <span class="bg-white text-gray-800 px-6 py-3 rounded-full font-semibold shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                  <i class="ri-eye-line mr-2"></i>Xem chi tiết
                </span>
              </a>

              <!-- Sale Badge (if needed) -->
              <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold opacity-0">
                -20%
              </div>
            </div>

            <!-- Product Info -->
            <div class="p-6">
              <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-primary transition-colors duration-300">
                {{ $product->name }}
              </h3>
              <p class="text-gray-600 mb-4 text-sm leading-relaxed line-clamp-2">
                {{ $product->description }}
              </p>

              <!-- Rating -->
              <div class="flex items-center mb-4">
                @if($product->reviews && $product->reviews->count() > 0)
                  @php
                    $averageRating = $product->reviews->avg('rating');
                    $reviewCount = $product->reviews->count();
                    $fullStars = floor($averageRating);
                    $hasHalfStar = ($averageRating - $fullStars) >= 0.5;
                  @endphp
                  <div class="flex text-yellow-400 text-sm mr-2">
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
                  <span class="text-gray-500 text-sm">({{ number_format($averageRating, 1) }})</span>
                  <span class="text-gray-400 text-xs ml-1">• {{ $reviewCount }} đánh giá</span>
                @else
                  <div class="flex text-gray-300 text-sm mr-2">
                    @for($i = 1; $i <= 5; $i++)
                      <i class="ri-star-line"></i>
                    @endfor
                  </div>
                  <span class="text-gray-500 text-sm">(Chưa có đánh giá)</span>
                @endif
              </div>

              <!-- Price and Add to Cart -->
              <div class="flex justify-between items-center">
                <div class="flex flex-col">
                  <span class="text-2xl font-bold text-primary">{{ number_format($product->price) }}đ</span>
                  <span class="text-sm text-gray-500 line-through opacity-0">{{ number_format($product->price * 1.2) }}đ</span>
                </div>

                <button
                  class="add-to-cart group/btn bg-gradient-to-r from-primary to-secondary text-white px-6 py-3 rounded-xl hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 font-semibold"
                  data-product-id="{{ $product->id }}"
                  data-product-name="{{ $product->name }}"
                  data-product-price="{{ $product->price }}"
                  data-product-image="{{ $product->image }}"
                >
                  <i class="ri-shopping-cart-line mr-2 group-hover/btn:animate-bounce"></i>
                  <span class="hidden sm:inline">Thêm vào giỏ</span>
                  <span class="sm:hidden">+</span>
                </button>
              </div>
            </div>

            <!-- Hover Effect Border -->
            <div class="absolute inset-0 border-2 border-primary rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
          </div>
          @endforeach
        </div>

        <!-- View All Products Button -->
        <div class="text-center mt-16">
          <a href="#" class="inline-flex items-center bg-white border-2 border-primary text-primary px-8 py-4 rounded-xl text-lg font-semibold hover:bg-primary hover:text-white transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
            <i class="ri-grid-line mr-3"></i>
            Xem tất cả sản phẩm
            <i class="ri-arrow-right-line ml-3"></i>
          </a>
        </div>
      </div>
    </section>
    <!-- About Section -->
    <section id="about" class="py-16 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center gap-12">
          <div class="md:w-1/2">
            <img
              src="{{ asset('img/store1.jpg')}}"
              alt="Về chúng tôi"
              class="w-full h-auto rounded-lg shadow-lg"
            />
          </div>
          <div class="md:w-1/2">
            <h2 class="text-3xl font-bold mb-6">Về Sweet Cake</h2>
            <p class="text-gray-600 mb-4">
              Sweet Cake được thành lập vào năm 2015 với niềm đam mê mang đến
              những chiếc bánh kem tươi ngon, chất lượng cao cho mọi dịp đặc
              biệt của khách hàng.
            </p>
            <p class="text-gray-600 mb-4">
              Chúng tôi tự hào sử dụng những nguyên liệu tươi ngon nhất, không
              chất bảo quản, để tạo ra những chiếc bánh không chỉ đẹp mắt mà còn
              mang hương vị tuyệt vời.
            </p>
            <p class="text-gray-600 mb-6">
              Đội ngũ đầu bếp của chúng tôi luôn không ngừng sáng tạo, học hỏi
              để mang đến những sản phẩm mới lạ, đáp ứng nhu cầu ngày càng cao
              của khách hàng.
            </p>
            <div class="flex flex-wrap gap-4">
              <div class="flex items-center">
                <div
                  class="w-12 h-12 flex items-center justify-center bg-primary bg-opacity-10 rounded-full text-primary"
                >
                  <i class="ri-cake-3-line text-2xl"></i>
                </div>
                <div class="ml-4">
                  <h4 class="font-bold">100% Tự Nhiên</h4>
                  <p class="text-sm text-gray-600">Không chất bảo quản</p>
                </div>
              </div>
              <div class="flex items-center">
                <div
                  class="w-12 h-12 flex items-center justify-center bg-primary bg-opacity-10 rounded-full text-primary"
                >
                  <i class="ri-truck-line text-2xl"></i>
                </div>
                <div class="ml-4">
                  <h4 class="font-bold">Giao Hàng</h4>
                  <p class="text-sm text-gray-600">Nhanh chóng, an toàn</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Testimonials Section -->
    <section class="py-16">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">
          Khách Hàng Nói Gì Về Chúng Tôi
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Testimonial 1 -->
          <div class="bg-white p-8 rounded-lg shadow-md">
            <div class="flex items-center mb-4">
              <div class="text-primary">
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
              </div>
            </div>
            <p class="text-gray-600 mb-6">
              "Bánh kem của Sweet Cake luôn là lựa chọn hàng đầu của gia đình
              tôi cho mọi dịp đặc biệt. Bánh không chỉ đẹp mắt mà còn rất ngon,
              không quá ngọt và luôn tươi mới."
            </p>
            <div class="flex items-center">
              <div
                class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center"
              >
                <i class="ri-user-line text-gray-500"></i>
              </div>
              <div class="ml-4">
                <h4 class="font-bold">Nguyễn Thị Hương</h4>
                <p class="text-sm text-gray-500">Khách hàng thân thiết</p>
              </div>
            </div>
          </div>
          <!-- Testimonial 2 -->
          <div class="bg-white p-8 rounded-lg shadow-md">
            <div class="flex items-center mb-4">
              <div class="text-primary">
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
              </div>
            </div>
            <p class="text-gray-600 mb-6">
              "Đặt bánh sinh nhật cho con trai và vô cùng hài lòng với chất
              lượng. Bánh không chỉ đẹp mà còn rất ngon, con trai tôi rất thích.
              Chắc chắn sẽ quay lại!"
            </p>
            <div class="flex items-center">
              <div
                class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center"
              >
                <i class="ri-user-line text-gray-500"></i>
              </div>
              <div class="ml-4">
                <h4 class="font-bold">Trần Văn Minh</h4>
                <p class="text-sm text-gray-500">Khách hàng mới</p>
              </div>
            </div>
          </div>
          <!-- Testimonial 3 -->
          <div class="bg-white p-8 rounded-lg shadow-md">
            <div class="flex items-center mb-4">
              <div class="text-primary">
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-half-fill"></i>
              </div>
            </div>
            <p class="text-gray-600 mb-6">
              "Đặt bánh cưới tại Sweet Cake là quyết định đúng đắn nhất của
              chúng tôi. Bánh không chỉ đẹp mắt mà còn rất ngon, được nhiều
              khách mời khen ngợi."
            </p>
            <div class="flex items-center">
              <div
                class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center"
              >
                <i class="ri-user-line text-gray-500"></i>
              </div>
              <div class="ml-4">
                <h4 class="font-bold">Lê Thị Mai Anh</h4>
                <p class="text-sm text-gray-500">Đám cưới 05/2025</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Newsletter Section -->
    <section class="py-16 bg-primary bg-opacity-10">
      <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
          <h2 class="text-3xl font-bold mb-4">Đăng Ký Nhận Thông Tin</h2>
          <p class="text-gray-600 mb-8">
            Đăng ký để nhận thông tin về sản phẩm mới và ưu đãi đặc biệt từ
            Sweet Cake
          </p>
          <div class="flex flex-col sm:flex-row gap-4">
            <input
              type="email"
              placeholder="Nhập email của bạn"
              class="flex-1 px-4 py-3 rounded-button border border-gray-300 focus:outline-none focus:border-primary"
            />
            <button
              class="bg-primary text-white px-6 py-3 rounded-button font-medium hover:bg-opacity-90 transition-colors whitespace-nowrap"
            >
              Đăng ký
            </button>
          </div>
        </div>
      </div>
    </section>
    <!-- Contact Section -->
    <section id="contact" class="py-16">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">
          Liên Hệ Với Chúng Tôi
        </h2>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Thành công!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <div class="flex flex-col md:flex-row gap-12">
          <div class="md:w-1/2">
            <form action="{{ route('contact.store') }}" method="POST">
              @csrf
              <div class="mb-6">
                <label for="name" class="block text-gray-700 mb-2"
                  >Họ và tên</label
                >
                <input
                  type="text"
                  id="name"
                  name="name"
                  class="w-full px-4 py-3 rounded-button border @error('name') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:border-primary"
                  value="{{ old('name') }}"
                />
                 @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-6">
                <label for="email" class="block text-gray-700 mb-2"
                  >Email</label
                >
                <input
                  type="email"
                  id="email"
                  name="email"
                  class="w-full px-4 py-3 rounded-button border @error('email') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:border-primary"
                   value="{{ old('email') }}"
                />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-6">
                <label for="phone" class="block text-gray-700 mb-2"
                  >Số điện thoại</label
                >
                <input
                  type="tel"
                  id="phone"
                  name="phone"
                  class="w-full px-4 py-3 rounded-button border @error('phone') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:border-primary"
                  value="{{ old('phone') }}"
                />
                 @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-6">
                <label for="message" class="block text-gray-700 mb-2"
                  >Nội dung</label
                >
                <textarea
                  id="message"
                  name="message"
                  rows="5"
                  class="w-full px-4 py-3 rounded-button border @error('message') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:border-primary"
                >{{ old('message') }}</textarea>
                 @error('message')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
              <button
                type="submit"
                class="bg-primary text-white px-6 py-3 rounded-button font-medium hover:bg-opacity-90 transition-colors whitespace-nowrap"
              >
                Gửi tin nhắn
              </button>
            </form>
          </div>
          <div class="md:w-1/2">
            <div class="bg-white p-8 rounded-lg shadow-md h-full">
              <h3 class="text-xl font-bold mb-6">Thông Tin Liên Hệ</h3>
              <div class="space-y-6">
                <div class="flex items-start">
                  <div
                    class="w-10 h-10 flex items-center justify-center bg-primary bg-opacity-10 rounded-full text-primary mt-1"
                  >
                    <i class="ri-map-pin-line"></i>
                  </div>
                  <div class="ml-4">
                    <h4 class="font-bold">Địa chỉ</h4>
                    <p class="text-gray-600">
                      abc
                    </p>
                  </div>
                </div>
                <div class="flex items-start">
                  <div
                    class="w-10 h-10 flex items-center justify-center bg-primary bg-opacity-10 rounded-full text-primary mt-1"
                  >
                    <i class="ri-phone-line"></i>
                  </div>
                  <div class="ml-4">
                    <h4 class="font-bold">Điện thoại</h4>
                    <p class="text-gray-600">+84 28 1234 5678</p>
                  </div>
                </div>
                <div class="flex items-start">
                  <div
                    class="w-10 h-10 flex items-center justify-center bg-primary bg-opacity-10 rounded-full text-primary mt-1"
                  >
                    <i class="ri-mail-line"></i>
                  </div>
                  <div class="ml-4">
                    <h4 class="font-bold">Email</h4>
                    <p class="text-gray-600">info@sweetcake.vn</p>
                  </div>
                </div>
                <div class="flex items-start">
                  <div
                    class="w-10 h-10 flex items-center justify-center bg-primary bg-opacity-10 rounded-full text-primary mt-1"
                  >
                    <i class="ri-time-line"></i>
                  </div>
                  <div class="ml-4">
                    <h4 class="font-bold">Giờ mở cửa</h4>
                    <p class="text-gray-600">Thứ 2 - Chủ nhật: 8:00 - 21:00</p>
                  </div>
                </div>
              </div>
              <div class="mt-8">
                <h4 class="font-bold mb-4">Theo dõi chúng tôi</h4>
                <div class="flex space-x-4">
                  <a
                    href="#"
                    class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-full text-gray-600 hover:bg-primary hover:text-white transition-colors"
                  >
                    <i class="ri-facebook-fill"></i>
                  </a>
                  <a
                    href="#"
                    class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-full text-gray-600 hover:bg-primary hover:text-white transition-colors"
                  >
                    <i class="ri-instagram-line"></i>
                  </a>
                  <a
                    href="#"
                    class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-full text-gray-600 hover:bg-primary hover:text-white transition-colors"
                  >
                    <i class="ri-tiktok-line"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection
