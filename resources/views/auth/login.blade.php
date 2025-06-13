{{-- @extends('front.layout.master')

@section('title', 'Đăng nhập')

@section('content') --}}
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập - Sweet Cake</title>
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
    <style>
      :where([class^="ri-"])::before { content: "\f3c2"; }
      body {
        font-family: 'Montserrat', sans-serif;
        background-image: url('https://readdy.ai/api/search-image?query=beautiful%20cake%20shop%20interior%20with%20soft%20pastel%20colors%2C%20elegant%20display%20of%20cakes%2C%20warm%20lighting%2C%20blurred%20background%20perfect%20for%20login%20page%2C%20professional%20photography&width=1920&height=1080&seq=login_bg&orientation=landscape');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        min-height: 100vh;
      }
      .custom-checkbox {
        position: relative;
        padding-left: 30px;
        cursor: pointer;
        user-select: none;
      }
      .custom-checkbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
      }
      .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #fff;
        border: 2px solid #ddd;
        border-radius: 4px;
      }
      .custom-checkbox:hover input ~ .checkmark {
        border-color: #ccc;
      }
      .custom-checkbox input:checked ~ .checkmark {
        background-color: #ff6b6b;
        border-color: #ff6b6b;
      }
      .checkmark:after {
        content: "";
        position: absolute;
        display: none;
      }
      .custom-checkbox input:checked ~ .checkmark:after {
        display: block;
      }
      .custom-checkbox .checkmark:after {
        left: 6px;
        top: 2px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
      }
    </style>
  </head>
  <body class="flex items-center justify-center p-4">
    <div class="w-full max-w-md">
      <div
        class="bg-white rounded-lg shadow-xl p-8 backdrop-blur-sm bg-opacity-95"
      >
        <div class="text-center mb-8">
          <a href="/" class="inline-block">
            <h1 class="text-4xl font-['Pacifico'] text-primary mb-2">
              Sweet Cake
            </h1>
          </a>
          <p class="text-gray-600">Chào mừng bạn quay trở lại</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
          <div>
            <label
              for="email"
              class="block text-sm font-medium text-gray-700 mb-2"
              >Email</label
            >
            <div class="relative">
              <div
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
              >
                <i class="ri-mail-line text-gray-400"></i>
              </div>
              <input
                type="email"
                id="email"
                name="email"
                required
                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-button text-sm focus:outline-none focus:border-primary"
                placeholder="Nhập email của bạn"
              />
            </div>
          </div>

          <div>
            <label
              for="password"
              class="block text-sm font-medium text-gray-700 mb-2"
              >Mật khẩu</label
            >
            <div class="relative">
              <div
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
              >
                <i class="ri-lock-line text-gray-400"></i>
              </div>
              <input
                type="password"
                id="password"
                name="password"
                required
                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-button text-sm focus:outline-none focus:border-primary"
                placeholder="Nhập mật khẩu"
              />
            </div>
          </div>

          <div class="flex items-center justify-between">
            <label class="custom-checkbox text-sm text-gray-600">
              Ghi nhớ đăng nhập
              <input type="checkbox" name="remember" />
              <span class="checkmark"></span>
            </label>
            <a href="#" class="text-sm text-primary hover:text-opacity-80"
              >Quên mật khẩu?</a
            >
          </div>

          <button
            type="submit"
            class="w-full bg-primary text-white py-3 rounded-button font-medium hover:bg-opacity-90 transition-colors whitespace-nowrap"
          >
            Đăng nhập
          </button>
        </form>
        <p class="mt-8 text-center text-sm text-gray-600">
          Chưa có tài khoản?
          <a
            href="/register"
            class="font-medium text-primary hover:text-opacity-80"
            >Đăng ký ngay</a
          >
        </p>
      </div>
    </div>
    <script src="{{ asset('js/main.js') }}"></script>
  </body>
</html>
{{--
@endsection --}}
