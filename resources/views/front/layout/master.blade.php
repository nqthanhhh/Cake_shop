
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') | sweetcake</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: { primary: "#ff6b6b", secondary: "#ffd166" },
            borderRadius: {
              none: "0px",
              sm: "4px",
              DEFAULT: "8px",
              md: "12px",
              lg: "16px",
              xl: "20px",
              "2xl": "24px",
              "3xl": "32px",
              full: "9999px",
              button: "8px",
            },
          },
        },
      };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"
    />

  </head>
  <body class="bg-white min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
      <div
        class="container mx-auto px-4 py-4 flex items-center justify-between"
      >
        <a href="#" class="text-3xl font-['Pacifico'] text-primary"
          >Sweet Cake</a
        >
        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-8">
          <a
            href="#"
            class="text-gray-800 font-medium hover:text-primary transition-colors"
            >Trang chủ</a
          >
          <a
            href="#products"
            class="text-gray-800 font-medium hover:text-primary transition-colors"
            >Sản phẩm</a
          >
          <a
            href="#about"
            class="text-gray-800 font-medium hover:text-primary transition-colors"
            >Về chúng tôi</a
          >
          <a
            href="#contact"
            class="text-gray-800 font-medium hover:text-primary transition-colors"
            >Liên hệ</a
          >
        </nav>
        <div class="flex items-center space-x-4">
          <a
            href="{{ route('login') }}"
            class="hidden md:block text-gray-800 hover:text-primary transition-colors font-medium"
            >Đăng nhập</a
          >
          <a
            href="{{ route('register') }}"
            class="hidden md:block bg-primary text-white px-4 py-2 rounded-button hover:bg-opacity-90 transition-colors font-medium whitespace-nowrap"
            >Đăng ký</a
          >
          <div class="relative">
            <a
              href="/cart"
              class="w-10 h-10 flex items-center justify-center text-gray-800 hover:text-primary transition-colors"
            >
              <i class="ri-shopping-cart-2-line text-xl"></i>
              <span class="cart-badge">0</span>
            </a>
          </div>
          <button
            id="mobileMenuBtn"
            class="md:hidden w-10 h-10 flex items-center justify-center"
          >
            <i class="ri-menu-line text-2xl"></i>
          </button>
        </div>
      </div>
      <!-- Mobile Navigation -->
      <div id="mobileMenu" class="md:hidden hidden bg-white border-t">
        <div class="container mx-auto px-4 py-2 flex flex-col">
          <a href="#" class="py-3 border-b border-gray-100 text-gray-800"
            >Trang chủ</a
          >
          <a
            href="#products"
            class="py-3 border-b border-gray-100 text-gray-800"
            >Sản phẩm</a
          >
          <a href="#about" class="py-3 border-b border-gray-100 text-gray-800"
            >Về chúng tôi</a
          >
          <a href="#contact" class="py-3 border-b border-gray-100 text-gray-800"
            >Liên hệ</a
          >
          <div class="py-3 flex space-x-4">
            <a href="{{ route('login') }}" class="text-gray-800 font-medium">Đăng nhập</a>
            <a
              href="{{ route('register') }}"
              class="bg-primary text-white px-4 py-2 rounded-button font-medium whitespace-nowrap"
              >Đăng ký</a
            >
          </div>
        </div>
      </div>
    </header>
    {{-- header end --}}
@yield('content')
    <!-- Main content -->

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
          <div>
            <h3 class="text-2xl font-['Pacifico'] mb-6">Sweet Cake</h3>
            <p class="text-gray-400 mb-6">
              Mang đến những chiếc bánh ngọt ngào cho mọi khoảnh khắc đặc biệt
              của bạn
            </p>
            <div class="flex space-x-4">
              <a
                href="#"
                class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded-full text-gray-400 hover:bg-primary hover:text-white transition-colors"
              >
                <i class="ri-facebook-fill"></i>
              </a>
              <a
                href="#"
                class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded-full text-gray-400 hover:bg-primary hover:text-white transition-colors"
              >
                <i class="ri-instagram-line"></i>
              </a>
              <a
                href="#"
                class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded-full text-gray-400 hover:bg-primary hover:text-white transition-colors"
              >
                <i class="ri-youtube-line"></i>
              </a>
            </div>
          </div>
          <div>
            <h4 class="text-lg font-bold mb-6">Liên kết nhanh</h4>
            <ul class="space-y-3">
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-primary transition-colors"
                  >Trang chủ</a
                >
              </li>
              <li>
                <a
                  href="#products"
                  class="text-gray-400 hover:text-primary transition-colors"
                  >Sản phẩm</a
                >
              </li>
              <li>
                <a
                  href="#about"
                  class="text-gray-400 hover:text-primary transition-colors"
                  >Về chúng tôi</a
                >
              </li>
              <li>
                <a
                  href="#contact"
                  class="text-gray-400 hover:text-primary transition-colors"
                  >Liên hệ</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-primary transition-colors"
                  >Điều khoản sử dụng</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-primary transition-colors"
                  >Chính sách bảo mật</a
                >
              </li>
            </ul>
          </div>
          <div>
            <h4 class="text-lg font-bold mb-6">Sản phẩm</h4>
            <ul class="space-y-3">
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-primary transition-colors"
                  >Bánh sinh nhật</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-primary transition-colors"
                  >Bánh cưới</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-primary transition-colors"
                  >Bánh theo chủ đề</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-primary transition-colors"
                  >Bánh theo dịp</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-primary transition-colors"
                  >Bánh kem trái cây</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-primary transition-colors"
                  >Bánh mousse</a
                >
              </li>
            </ul>
          </div>
          <div>
            <h4 class="text-lg font-bold mb-6">Liên hệ</h4>
            <ul class="space-y-3">
              <li class="flex items-start">
                <i class="ri-map-pin-line mt-1 mr-3"></i>
                <span class="text-gray-400"
                  >123 Nguyễn Văn Linh, Quận 7, TP. Hồ Chí Minh</span
                >
              </li>
              <li class="flex items-start">
                <i class="ri-phone-line mt-1 mr-3"></i>
                <span class="text-gray-400">+84 28 1234 5678</span>
              </li>
              <li class="flex items-start">
                <i class="ri-mail-line mt-1 mr-3"></i>
                <span class="text-gray-400">info@sweetcake.vn</span>
              </li>
            </ul>
            <h4 class="text-lg font-bold mt-8 mb-4">Phương thức thanh toán</h4>
            <div class="flex space-x-3">
              <i class="ri-visa-fill text-2xl text-gray-400"></i>
              <i class="ri-mastercard-fill text-2xl text-gray-400"></i>
              <i class="ri-paypal-fill text-2xl text-gray-400"></i>
              <i class="ri-bank-card-fill text-2xl text-gray-400"></i>
            </div>
          </div>
        </div>
        <div class="border-t border-gray-800 pt-8">
          <p class="text-gray-400 text-center">
            © 2025 Sweet Cake. Tất cả các quyền được bảo lưu.
          </p>
        </div>
      </div>
    </footer>
    <!-- Removed login and register modals since they will be separate pages -->
    <!-- Cart Sidebar -->
    <div
      id="cartSidebar"
      class="fixed top-0 right-0 h-full w-full md:w-96 bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-50"
    >
      <div class="h-full flex flex-col">
        <div
          class="p-4 border-b border-gray-200 flex justify-between items-center"
        >
          <h3 class="text-xl font-bold">Giỏ hàng của bạn</h3>
          <button id="closeCartBtn" class="text-gray-500 hover:text-gray-700">
            <i class="ri-close-line text-2xl"></i>
          </button>
        </div>
        <div id="cartItems" class="flex-grow overflow-y-auto p-4">
          <!-- Empty cart message -->
          <div id="emptyCart" class="text-center py-8">
            <div
              class="w-20 h-20 mx-auto mb-4 flex items-center justify-center bg-gray-100 rounded-full text-gray-400"
            >
              <i class="ri-shopping-cart-line text-3xl"></i>
            </div>
            <p class="text-gray-500 mb-4">Giỏ hàng của bạn đang trống</p>
            <button
              id="continueShopping"
              class="bg-primary text-white px-4 py-2 rounded-button hover:bg-opacity-90 transition-colors whitespace-nowrap"
            >
              Tiếp tục mua sắm
            </button>
          </div>
          <!-- Cart items will be added here dynamically -->
        </div>
        <div class="p-4 border-t border-gray-200">
          <div class="flex justify-between mb-4">
            <span class="font-medium">Tổng cộng:</span>
            <span id="cartTotal" class="font-bold">0đ</span>
          </div>
          <button
            id="checkoutBtn"
            class="w-full bg-primary text-white py-3 rounded-button font-medium hover:bg-opacity-90 transition-colors whitespace-nowrap"
          >
            Thanh toán
          </button>
        </div>
      </div>
    </div>
    <script src="{{ asset('js/main.js') }}"></script>
  </body>
</html>
