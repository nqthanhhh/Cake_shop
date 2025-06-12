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
          <!-- Category 1 -->
          <div
            class="category-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300"
          >
            <div class="h-48 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=beautiful%20birthday%20cake%20with%20colorful%20decorations%2C%20candles%2C%20cream%20frosting%2C%20elegant%20design%2C%20professional%20photography%20on%20soft%20white%20background%2C%20high-end%20bakery%20product&width=600&height=400&seq=cat1&orientation=landscape"
                alt="Bánh sinh nhật"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold mb-2">Bánh Sinh Nhật</h3>
              <p class="text-gray-600 mb-4">
                Những chiếc bánh đặc biệt cho ngày đặc biệt của bạn
              </p>
              <a href="#" class="text-primary font-medium flex items-center">
                Xem thêm
                <i class="ri-arrow-right-line ml-2"></i>
              </a>
            </div>
          </div>
          <!-- Category 2 -->
          <div
            class="category-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300"
          >
            <div class="h-48 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=elegant%20wedding%20cake%20with%20multiple%20tiers%2C%20white%20frosting%2C%20delicate%20floral%20decorations%2C%20professional%20photography%20on%20soft%20white%20background%2C%20high-end%20bakery%20product%2C%20luxury%20wedding%20dessert&width=600&height=400&seq=cat2&orientation=landscape"
                alt="Bánh cưới"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold mb-2">Bánh Cưới</h3>
              <p class="text-gray-600 mb-4">
                Bánh cưới sang trọng cho ngày trọng đại
              </p>
              <a href="#" class="text-primary font-medium flex items-center">
                Xem thêm
                <i class="ri-arrow-right-line ml-2"></i>
              </a>
            </div>
          </div>
          <!-- Category 3 -->
          <div
            class="category-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300"
          >
            <div class="h-48 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=themed%20cake%20with%20creative%20design%2C%20character%20decorations%2C%20colorful%20frosting%2C%20professional%20photography%20on%20soft%20white%20background%2C%20high-end%20bakery%20product%2C%20childrens%20party%20cake&width=600&height=400&seq=cat3&orientation=landscape"
                alt="Bánh theo chủ đề"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold mb-2">Bánh Theo Chủ Đề</h3>
              <p class="text-gray-600 mb-4">
                Bánh được thiết kế theo ý tưởng của bạn
              </p>
              <a href="#" class="text-primary font-medium flex items-center">
                Xem thêm
                <i class="ri-arrow-right-line ml-2"></i>
              </a>
            </div>
          </div>
          <!-- Category 4 -->
          <div
            class="category-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300"
          >
            <div class="h-48 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=seasonal%20cake%20with%20holiday%20decorations%2C%20festive%20design%2C%20cream%20frosting%2C%20professional%20photography%20on%20soft%20white%20background%2C%20high-end%20bakery%20product%2C%20Christmas%20or%20New%20Year%20cake&width=600&height=400&seq=cat4&orientation=landscape"
                alt="Bánh theo dịp"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold mb-2">Bánh Theo Dịp</h3>
              <p class="text-gray-600 mb-4">
                Bánh cho các dịp lễ đặc biệt trong năm
              </p>
              <a href="#" class="text-primary font-medium flex items-center">
                Xem thêm
                <i class="ri-arrow-right-line ml-2"></i>
              </a>
            </div>
          </div>
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
        <div
          class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8"
        >
          <!-- Product 1 -->
          <div
            class="product-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300"
          >
            <div class="h-56 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=strawberry%20cream%20cake%20with%20fresh%20strawberries%20on%20top%2C%20smooth%20cream%20frosting%2C%20professional%20photography%20on%20soft%20white%20background%2C%20high-end%20bakery%20product&width=500&height=400&seq=prod1&orientation=landscape"
                alt="Bánh Dâu Tươi"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold mb-2">Bánh Dâu Tươi</h3>
              <p class="text-gray-600 mb-4">
                Bánh kem tươi ngon với lớp dâu tây tươi phủ trên bề mặt
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold text-xl">320.000đ</span>
                <a
                  href="/product-detail"
                  class="bg-primary text-white px-4 py-2 rounded-button hover:bg-opacity-90 transition-colors whitespace-nowrap text-center"
                  >Chi tiết</a
                >
              </div>
            </div>
          </div>
          <!-- Product 2 -->
          <div
            class="product-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300"
          >
            <div class="h-56 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=chocolate%20cake%20with%20chocolate%20ganache%2C%20chocolate%20shavings%20on%20top%2C%20rich%20and%20moist%2C%20professional%20photography%20on%20soft%20white%20background%2C%20high-end%20bakery%20product&width=500&height=400&seq=prod2&orientation=landscape"
                alt="Bánh Socola"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold mb-2">Bánh Socola Đặc Biệt</h3>
              <p class="text-gray-600 mb-4">
                Bánh socola đậm đà với lớp ganache mềm mịn
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold text-xl">350.000đ</span>
                <button
                  class="add-to-cart bg-primary text-white px-4 py-2 rounded-button hover:bg-opacity-90 transition-colors whitespace-nowrap"
                >
                  Thêm vào giỏ
                </button>
              </div>
            </div>
          </div>
          <!-- Product 3 -->
          <div
            class="product-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300"
          >
            <div class="h-56 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=tiramisu%20cake%20with%20coffee%20flavor%2C%20dusted%20with%20cocoa%20powder%2C%20creamy%20layers%2C%20professional%20photography%20on%20soft%20white%20background%2C%20high-end%20bakery%20product&width=500&height=400&seq=prod3&orientation=landscape"
                alt="Bánh Tiramisu"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold mb-2">Bánh Tiramisu</h3>
              <p class="text-gray-600 mb-4">
                Bánh tiramisu hương vị cà phê Ý truyền thống
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold text-xl">280.000đ</span>
                <button
                  class="add-to-cart bg-primary text-white px-4 py-2 rounded-button hover:bg-opacity-90 transition-colors whitespace-nowrap"
                >
                  Thêm vào giỏ
                </button>
              </div>
            </div>
          </div>
          <!-- Product 4 -->
          <div
            class="product-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300"
          >
            <div class="h-56 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=blueberry%20cheesecake%20with%20fresh%20blueberries%20on%20top%2C%20smooth%20cream%20cheese%20texture%2C%20professional%20photography%20on%20soft%20white%20background%2C%20high-end%20bakery%20product&width=500&height=400&seq=prod4&orientation=landscape"
                alt="Bánh Phô Mai Việt Quất"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold mb-2">Bánh Phô Mai Việt Quất</h3>
              <p class="text-gray-600 mb-4">
                Bánh phô mai mềm mịn với lớp việt quất tươi ngon
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold text-xl">300.000đ</span>
                <button
                  class="add-to-cart bg-primary text-white px-4 py-2 rounded-button hover:bg-opacity-90 transition-colors whitespace-nowrap"
                >
                  Thêm vào giỏ
                </button>
              </div>
            </div>
          </div>
          <!-- Product 5 -->
          <div
            class="product-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300"
          >
            <div class="h-56 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=matcha%20green%20tea%20cake%20with%20matcha%20powder%20dusting%2C%20cream%20layers%2C%20professional%20photography%20on%20soft%20white%20background%2C%20high-end%20bakery%20product&width=500&height=400&seq=prod5&orientation=landscape"
                alt="Bánh Trà Xanh"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold mb-2">Bánh Trà Xanh</h3>
              <p class="text-gray-600 mb-4">
                Bánh kem trà xanh matcha thơm ngon, thanh mát
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold text-xl">290.000đ</span>
                <button
                  class="add-to-cart bg-primary text-white px-4 py-2 rounded-button hover:bg-opacity-90 transition-colors whitespace-nowrap"
                >
                  Thêm vào giỏ
                </button>
              </div>
            </div>
          </div>
          <!-- Product 6 -->
          <div
            class="product-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300"
          >
            <div class="h-56 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=red%20velvet%20cake%20with%20cream%20cheese%20frosting%2C%20red%20cake%20layers%2C%20professional%20photography%20on%20soft%20white%20background%2C%20high-end%20bakery%20product&width=500&height=400&seq=prod6&orientation=landscape"
                alt="Bánh Red Velvet"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold mb-2">Bánh Red Velvet</h3>
              <p class="text-gray-600 mb-4">
                Bánh red velvet với lớp kem phô mai mềm mịn
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold text-xl">330.000đ</span>
                <button
                  class="add-to-cart bg-primary text-white px-4 py-2 rounded-button hover:bg-opacity-90 transition-colors whitespace-nowrap"
                >
                  Thêm vào giỏ
                </button>
              </div>
            </div>
          </div>
          <!-- Product 7 -->
          <div
            class="product-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300"
          >
            <div class="h-56 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=fruit%20tart%20cake%20with%20mixed%20fresh%20fruits%20on%20top%2C%20custard%20filling%2C%20professional%20photography%20on%20soft%20white%20background%2C%20high-end%20bakery%20product&width=500&height=400&seq=prod7&orientation=landscape"
                alt="Bánh Tart Trái Cây"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold mb-2">Bánh Tart Trái Cây</h3>
              <p class="text-gray-600 mb-4">
                Bánh tart với các loại trái cây tươi theo mùa
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold text-xl">270.000đ</span>
                <button
                  class="add-to-cart bg-primary text-white px-4 py-2 rounded-button hover:bg-opacity-90 transition-colors whitespace-nowrap"
                >
                  Thêm vào giỏ
                </button>
              </div>
            </div>
          </div>
          <!-- Product 8 -->
          <div
            class="product-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300"
          >
            <div class="h-56 overflow-hidden">
              <img
                src="https://readdy.ai/api/search-image?query=mango%20mousse%20cake%20with%20fresh%20mango%20slices%2C%20light%20and%20airy%20texture%2C%20professional%20photography%20on%20soft%20white%20background%2C%20high-end%20bakery%20product&width=500&height=400&seq=prod8&orientation=landscape"
                alt="Bánh Mousse Xoài"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold mb-2">Bánh Mousse Xoài</h3>
              <p class="text-gray-600 mb-4">
                Bánh mousse xoài mềm mịn với lớp xoài tươi bên trên
              </p>
              <div class="flex justify-between items-center">
                <span class="text-primary font-bold text-xl">310.000đ</span>
                <button
                  class="add-to-cart bg-primary text-white px-4 py-2 rounded-button hover:bg-opacity-90 transition-colors whitespace-nowrap"
                >
                  Thêm vào giỏ
                </button>
              </div>
            </div>
          </div>
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
              src="https://readdy.ai/api/search-image?query=professional%20bakery%20interior%20with%20pastry%20chefs%20working%2C%20elegant%20cake%20shop%2C%20people%20decorating%20cakes%2C%20warm%20and%20inviting%20atmosphere%2C%20high-end%20bakery%2C%20professional%20photography&width=600&height=500&seq=about&orientation=landscape"
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
                      123 Nguyễn Văn Linh, Quận 7, TP. Hồ Chí Minh
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
