{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng ký - Sweet Cake</title>
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
      background-image: url("{{ asset('img/backgroud.jpg') }}");
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
          <p class="text-gray-600">Tạo tài khoản mới</p>
        </div>
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf
          <div>
            <div>
              <label
                for="name"
                class="block text-sm font-medium text-gray-700 mb-2"
                >Tên</label
              >
              <div class="relative">
                <div
                  class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                >
                  <i class="ri-user-line text-gray-400"></i>
                </div>
                <input
                  type="text"
                  id="name"
                  name="name"
                  required
                  class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-button text-sm focus:outline-none focus:border-primary"
                  placeholder="Nhập tên"
                />
              </div>
            </div>
          </div>
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
                value="{{ old('email') }}"
              />
            </div>
            @error('email')
              <p class="mt-1 text-sm text0-red-500">{{ $message }}</p>
            @enderror
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
          <div>
            <label
              for="confirmPassword"
              class="block text-sm font-medium text-gray-700 mb-2"
              >Xác nhận mật khẩu</label
            >
            <div class="relative">
              <div
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
              >
                <i class="ri-lock-line text-gray-400"></i>
              </div>
              <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                required
                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-button text-sm focus:outline-none focus:border-primary"
                placeholder="Nhập lại mật khẩu"
              />
            </div>
          </div>

          <button
            type="submit"
            class="w-full bg-primary text-white py-3 rounded-button font-medium hover:bg-opacity-90 transition-colors whitespace-nowrap"
          >
            Đăng ký
          </button>

        </form>
                <p class="mt-8 text-center text-sm text-gray-600">
          Đã có tài khoản?
          <a
            href="/login"
            class="font-medium text-primary hover:text-opacity-80"
            >Đăng nhập ngay</a
          >
        </p>
        <div class="mt-8 text-center">
                <p class="text-xs text-black/70">Bằng việc đăng ký, bạn đồng ý với <a href="#"
                        class="text-primary">Điều khoản dịch vụ</a> và <a href="#" class="text-primary">Chính sách bảo mật</a>
                    của chúng tôi</p>
            </div>
        </div>

      </div>
    </div>
    {{-- <script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("password_confirmation");
    const termsCheckbox = document.querySelector('input[name="terms"]');
            // Thêm modal thông báo

    function showAlert(message) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        modal.innerHTML = `
            <div class="bg-white p-6 rounded-lg shadow-xl max-w-sm mx-4">
                <div class="text-center">
                    <i class="ri-error-warning-line text-5xl text-primary mb-4"></i>
                    <p class="text-gray-800 mb-6">${message}</p>
                    <button onclick="this.closest('.fixed').remove()"
                            class="bg-primary text-white px-6 py-2 rounded-button hover:bg-opacity-90 transition-colors">
                        Đóng
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }

    function validateForm() {
        // Kiểm tra điều khoản
        if (!termsCheckbox.checked) {
            showAlert("Vui lòng đồng ý với điều khoản sử dụng và chính sách bảo mật");
            return false;
        }

        // Kiểm tra mật khẩu
        if (password.value !== confirmPassword.value) {
            showAlert("Mật khẩu không khớp");
            return false;
        }

        return true;
    }

    // Kiểm tra mật khẩu realtime
    confirmPassword.addEventListener("input", function() {
        if (password.value !== confirmPassword.value) {
            this.setCustomValidity("Mật khẩu không khớp");
        } else {
            this.setCustomValidity("");
        }
    });

    // Handle form submit
    form.addEventListener("submit", function(e) {
        e.preventDefault();

        if (validateForm()) {
            form.submit();
        }
    });
});
</script> --}}

<script src="{{ asset('js/main.js') }}"></script>
  </body>
</html>
