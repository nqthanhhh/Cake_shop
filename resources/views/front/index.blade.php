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
          <button
            class="bg-primary text-white px-6 py-3 rounded-button text-lg font-medium hover:bg-opacity-90 transition-colors whitespace-nowrap"
          >
            Đặt hàng ngay
          </button>
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
    <section id="products" class="py-16">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-4">Sản Phẩm Nổi Bật</h2>
        <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">
          Khám phá những chiếc bánh kem được yêu thích nhất tại Sweet Cake, được
          làm từ những nguyên liệu tươi ngon nhất
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
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

        <div class="text-center mt-12">
          <button
            class="bg-white border border-primary text-primary px-6 py-3 rounded-button text-lg font-medium hover:bg-primary hover:text-white transition-colors whitespace-nowrap"
          >
            Xem tất cả sản phẩm
          </button>
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
        <div class="flex flex-col md:flex-row gap-12">
          <div class="md:w-1/2">
            <form>
              <div class="mb-6">
                <label for="name" class="block text-gray-700 mb-2"
                  >Họ và tên</label
                >
                <input
                  type="text"
                  id="name"
                  class="w-full px-4 py-3 rounded-button border border-gray-300 focus:outline-none focus:border-primary"
                />
              </div>
              <div class="mb-6">
                <label for="email" class="block text-gray-700 mb-2"
                  >Email</label
                >
                <input
                  type="email"
                  id="email"
                  class="w-full px-4 py-3 rounded-button border border-gray-300 focus:outline-none focus:border-primary"
                />
              </div>
              <div class="mb-6">
                <label for="phone" class="block text-gray-700 mb-2"
                  >Số điện thoại</label
                >
                <input
                  type="tel"
                  id="phone"
                  class="w-full px-4 py-3 rounded-button border border-gray-300 focus:outline-none focus:border-primary"
                />
              </div>
              <div class="mb-6">
                <label for="message" class="block text-gray-700 mb-2"
                  >Nội dung</label
                >
                <textarea
                  id="message"
                  rows="5"
                  class="w-full px-4 py-3 rounded-button border border-gray-300 focus:outline-none focus:border-primary"
                ></textarea>
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
                      phenikaa, 167 Hoàng Quốc Việt, Cầu Giấy, Hà Nội
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
                    <i class="ri-youtube-line"></i>
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
