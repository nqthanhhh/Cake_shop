# 🎂 Sweet Cake Shop - Website Bán Bánh Kem

---

## 📋 **THÔNG TIN DỰ ÁN**

**🎯 Tên bài tập:** Website Bán Bánh Kem với Laravel Framework
**🔗 Link Repository:** [https://github.com/nqthanhhh/Cake_shop.git](https://github.com/nqthanhhh/Cake_shop.git)
**🌐 Link Demo:** `Sẽ cập nhật sau khi deploy`

### 👤 **Thông tin sinh viên:**

-   **Họ và tên:** Nguyễn Quốc Thành
-   **Mã sinh viên:** 23010038
-   **Môn học:** Lập trình Web - Bài tập giữa kỳ

---

## 📌 **MÔ TẢ DỰ ÁN**

Sweet Cake Shop là một ứng dụng web thương mại điện tử chuyên bán bánh kem được xây dựng bằng Laravel Framework. Dự án cung cấp trải nghiệm mua sắm trực tuyến hoàn chỉnh với giao diện thân thiện người dùng, hệ thống bảo mật cao và quản lý đơn hàng hiệu quả.

### 🎯 **Mục tiêu chính:**

-   ✅ Xây dựng ứng dụng e-commerce bánh kem hoàn chỉnh
-   ✅ Áp dụng các tính năng bảo mật tiên tiến
-   ✅ Tối ưu trải nghiệm người dùng (UX/UI)
-   ✅ Triển khai hệ thống quản lý đơn hàng và giỏ hàng
-   ✅ Tích hợp thanh toán đa phương thức

---

## ✅ **PHÂN TÍCH CÁC YÊU CẦU ĐÃ THỰC HIỆN**

### **1. Sử dụng framework Laravel** ✅

-   **Framework:** Laravel 12.x
-   **Cấu trúc:** MVC architecture hoàn chỉnh
-   **File cấu hình:** `composer.json`, `bootstrap/app.php`
-   **Routing:** Tổ chức routes trong `routes/web.php` và `routes/auth.php`

### **2. Ít nhất 03 đối tượng** ✅

Dự án đã triển khai **6 đối tượng chính:**

| Model         | File Path                  | Chức năng                          |
| ------------- | -------------------------- | ---------------------------------- |
| **User**      | `app/Models/User.php`      | Quản lý người dùng, authentication |
| **Product**   | `app/Models/Product.php`   | Quản lý sản phẩm bánh kem          |
| **Category**  | `app/Models/Category.php`  | Phân loại sản phẩm theo danh mục   |
| **Cart**      | `app/Models/Cart.php`      | Giỏ hàng người dùng                |
| **Order**     | `app/Models/Order.php`     | Đơn hàng                           |
| **OrderItem** | `app/Models/OrderItem.php` | Chi tiết đơn hàng                  |

### **3. Chức năng định danh và xác thực (Laravel Breeze)** ✅

**Authentication Controllers:**

-   `app/Http/Controllers/Auth/RegisteredUserController.php` - Đăng ký
-   `app/Http/Controllers/Auth/AuthenticatedSessionController.php` - Đăng nhập/Đăng xuất
-   `app/Http/Controllers/Auth/PasswordController.php` - Đổi mật khẩu
-   `app/Http/Controllers/Auth/EmailVerificationController.php` - Xác thực email

**Tính năng đã triển khai:**

```php
// Registration với validation
$request->validate([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
]);

// Login với session regeneration
$request->authenticate();
$request->session()->regenerate();
return redirect()->route('dashboard');
```

### **4. CRUD cho ít nhất 01 đối tượng** ✅

**CRUD hoàn chỉnh cho Cart (Giỏ hàng):**

| Operation  | Method | Route          | Controller Method               |
| ---------- | ------ | -------------- | ------------------------------- |
| **Create** | POST   | `/cart/add`    | `CartController@addToCart`      |
| **Read**   | GET    | `/cart`        | `CartController@getCart`        |
| **Update** | PUT    | `/cart/update` | `CartController@updateCart`     |
| **Delete** | DELETE | `/cart/{id}`   | `CartController@removeFromCart` |

**Code example:**

```php
// CREATE - Thêm sản phẩm vào giỏ
public function addToCart(Request $request) {
    $cart = Cart::updateOrCreate(
        ['user_id' => auth()->id(), 'product_id' => $productId],
        ['quantity' => DB::raw("quantity + $quantity")]
    );
}

// UPDATE - Cập nhật số lượng
public function updateCart(Request $request) {
    $cartItem = Cart::where('user_id', auth()->id())
        ->where('product_id', $productId)->first();
    $cartItem->quantity = $quantity;
    $cartItem->save();
}
```

**CRUD cho Order (Đơn hàng):**

-   **Create:** `OrderController@store` - Tạo đơn hàng mới
-   **Read:** `OrderController@show` - Xem chi tiết đơn hàng
-   **Update:** Cập nhật trạng thái đơn hàng
-   **Tracking:** Theo dõi đơn hàng trong dashboard

### **5. Các yêu cầu Security** ✅

#### **CSRF Protection:**

```blade
{{-- Trong tất cả forms --}}
@csrf
<form method="POST" action="{{ route('order.store') }}">
    @csrf
    <!-- form fields -->
</form>
```

#### **Data Validation:**

```php
// Trong OrderController.php
$request->validate([
    'customer_name' => 'required|string|max:255',
    'customer_email' => 'required|email|max:255',
    'customer_phone' => 'required|string|max:20',
    'customer_address' => 'required|string|max:500',
    'delivery_date' => 'required|date|after:today',
    'notes' => 'nullable|string|max:1000'
]);

// Trong CartController.php
$request->validate([
    'product_id' => 'required|integer',
    'quantity' => 'required|integer|min:1'
]);
```

#### **Authentication & Authorization:**

```php
// Middleware protection trong routes/web.php
Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/checkout', [OrderController::class, 'checkout']);
    Route::get('/dashboard', [UserDashboardController::class, 'index']);
});

// Authorization check trong OrderController
if ($order->user_id !== auth()->id()) {
    abort(403, 'Bạn không có quyền xem đơn hàng này.');
}
```

#### **XSS Protection:**

```blade
{{-- Blade syntax tự động escape output --}}
{{ $product->name }}  {{-- Safe output --}}
{{ $order->customer_name }}  {{-- Escaped automatically --}}
```

#### **SQL Injection Prevention:**

```php
// Sử dụng Eloquent ORM thay vì raw SQL
Cart::where('user_id', auth()->id())->with('product')->get();
Order::where('id', $orderId)->where('user_id', Auth::id())->firstOrFail();
```

#### **Session & Cookie Security:**

```php
// Session management
$request->session()->regenerate(); // Trong login
$request->session()->invalidate(); // Trong logout
$request->session()->regenerateToken(); // CSRF protection
```

### **6. Eloquent Migration trên Cloud** ✅

**Database Migrations:**

```bash
database/migrations/
├── 0001_01_01_000000_create_users_table.php
├── 0001_01_01_000001_create_cache_table.php
├── 0001_01_01_000002_create_jobs_table.php
├── 2025_06_12_061855_create_categories_table.php
├── 2025_06_12_061855_create_products_table.php
├── 2025_06_12_061855_create_orders_table.php
├── 2025_06_12_061856_create_cart_table.php
├── 2025_06_12_061856_create_order_items_table.php
├── 2025_06_12_061856_create_reviews_table.php
└── 2025_06_17_093212_add_detailed_description_to_products_table.php
```

**Seeders với dữ liệu mẫu:**

```bash
database/seeders/
├── DatabaseSeeder.php
├── CategorySeeder.php
└── ProductSeeder.php
```

**Migration example:**

```php
// products table
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description');
    $table->decimal('price', 10, 2);
    $table->string('image');
    $table->foreignId('category_id')->constrained()->onDelete('cascade');
    $table->integer('stock')->default(0);
    $table->boolean('is_featured')->default(false);
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});
```

### **7. Cập nhật README.md** ✅

-   ✅ Documentation chi tiết về dự án
-   ✅ Hướng dẫn cài đặt và sử dụng
-   ✅ Thông tin về security features
-   ✅ API documentation
-   ✅ Database schema
-   ✅ Link repository và demo

---

## 🛠️ **CÔNG NGHỆ SỬ DỤNG**

| Loại               | Công nghệ          | Phiên bản | Mô tả                 |
| ------------------ | ------------------ | --------- | --------------------- |
| **Backend**        | Laravel            | 12.x      | PHP Framework chính   |
| **Authentication** | Laravel Breeze     | 2.3+      | Hệ thống xác thực     |
| **Database**       | MySQL              | 8.0+      | Cơ sở dữ liệu         |
| **Frontend**       | Blade Templates    | -         | Template engine       |
| **CSS Framework**  | TailwindCSS        | 3.x       | Styling và responsive |
| **Icons**          | RemixIcon          | 4.6.0     | Bộ icon UI            |
| **Session**        | Laravel Session    | -         | Quản lý phiên         |
| **Validation**     | Laravel Validation | -         | Kiểm tra dữ liệu      |

---

## 🏗️ **KIẾN TRÚC HỆ THỐNG**

### **Models & Relationships:**

```
User (1) ←→ (n) Cart ←→ (1) Product
User (1) ←→ (n) Order (1) ←→ (n) OrderItem
Category (1) ←→ (n) Product
```

### **Controllers:**

-   `HomeController` - Trang chủ và danh sách sản phẩm
-   `ProductController` - Chi tiết sản phẩm
-   `CategoryController` - Danh mục sản phẩm
-   `CartController` - Quản lý giỏ hàng (CRUD)
-   `OrderController` - Quản lý đơn hàng (CRUD)
-   `UserDashboardController` - Dashboard người dùng
-   `Auth/*` - Các controller xác thực (Laravel Breeze)

### **Database Schema:**

```sql
users (id, name, email, password, phone, address, role, timestamps)
categories (id, name, description, image, slug, timestamps)
products (id, name, description, price, image, category_id, stock, is_featured, timestamps)
carts (id, user_id, product_id, quantity, timestamps)
orders (id, user_id, order_number, total_amount, status, customer_*, delivery_date, timestamps)
order_items (id, order_id, product_name, product_price, quantity, total_price, timestamps)
```

---

## 🚀 **TÍNH NĂNG CHÍNH**

### **Frontend Features:**

-   🏠 **Trang chủ**: Hiển thị danh mục và sản phẩm nổi bật
-   🛍️ **Catalog**: Duyệt sản phẩm theo danh mục
-   📱 **Responsive Design**: Tối ưu mobile và desktop
-   🛒 **Shopping Cart**: Thêm/xóa/cập nhật sản phẩm
-   💳 **Checkout**: Form đặt hàng với validation
-   👤 **User Dashboard**: Quản lý đơn hàng cá nhân

### **Backend Features:**

-   🔐 **Authentication**: Đăng ký/đăng nhập với Laravel Breeze
-   🛒 **Cart Management**: Lưu trữ trong database và session
-   📦 **Order Processing**: Xử lý đơn hàng với multiple status
-   💰 **Payment Methods**: COD, Bank Transfer
-   📧 **Notifications**: Hệ thống thông báo đơn hàng
-   📊 **Dashboard**: Theo dõi đơn hàng cho user

### **Security Features:**

-   🔒 **CSRF Protection**: Tokens trên tất cả forms
-   ✅ **Input Validation**: Server-side validation
-   🛡️ **XSS Protection**: Blade templating auto-escape
-   🔐 **SQL Injection Prevention**: Eloquent ORM
-   👤 **Authentication**: Session-based auth
-   🔑 **Authorization**: Middleware và permission checks

---

## ⚙️ **CÀI ĐẶT VÀ CHẠY DỰ ÁN**

### **Yêu cầu hệ thống:**

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL >= 8.0
-   Git

### **Các bước cài đặt:**

**1. Clone repository:**

```bash
git clone https://github.com/nqthanhhh/Cake_shop.git
cd Cake_Shop
```

**2. Cài đặt dependencies:**

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

**3. Cấu hình environment:**

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

**4. Cấu hình database:**

```env
# Chỉnh sửa .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cake_shop
DB_USERNAME=root
DB_PASSWORD=your_password
```

**5. Migration và Seeding:**

```bash
# Tạo database structure
php artisan migrate

# Seed dữ liệu mẫu
php artisan db:seed
```

**6. Build frontend assets:**

```bash
# Development
npm run dev

# Production
npm run build
```

**7. Chạy server:**

```bash
# Start development server
php artisan serve

# Application sẽ chạy tại: http://localhost:8000
```

---

## 🔗 **API ROUTES**

### **Authentication Routes:**

```php
GET  /login           - Trang đăng nhập
POST /login           - Xử lý đăng nhập
GET  /register        - Trang đăng ký
POST /register        - Xử lý đăng ký
POST /logout          - Đăng xuất
```

### **Cart Management (Auth Required):**

```php
POST   /cart/add         - Thêm sản phẩm vào giỏ
GET    /cart             - Xem giỏ hàng
PUT    /cart/update      - Cập nhật số lượng
DELETE /cart/{id}        - Xóa sản phẩm
GET    /cart/count       - Đếm số sản phẩm
```

### **Order Management (Auth Required):**

```php
GET  /checkout           - Trang thanh toán
POST /order              - Tạo đơn hàng
GET  /order/success/{id} - Trang thành công
GET  /order/{id}         - Chi tiết đơn hàng
```

### **Public Routes:**

```php
GET /                    - Trang chủ
GET /product/{id}        - Chi tiết sản phẩm
GET /category/{slug}     - Sản phẩm theo danh mục
```

---

## 🔒 **BÁO CÁO BẢO MẬT CHI TIẾT**

### **1. CSRF Protection ✅**

```php
// Middleware tự động trong Laravel
// Token được thêm vào mọi form
@csrf
<input type="hidden" name="_token" value="{{ csrf_token() }}">
```

### **2. Input Validation ✅**

```php
// Server-side validation
$request->validate([
    'customer_name' => 'required|string|max:255',
    'customer_email' => 'required|email|max:255',
    'product_id' => 'required|integer',
    'quantity' => 'required|integer|min:1'
]);
```

### **3. Authentication & Session Security ✅**

```php
// Session regeneration
$request->session()->regenerate();
$request->session()->invalidate();
$request->session()->regenerateToken();

// Middleware protection
Route::middleware('auth')->group(function () {
    // Protected routes
});
```

### **4. Authorization ✅**

```php
// Owner verification
if ($order->user_id !== auth()->id()) {
    abort(403, 'Unauthorized access');
}
```

### **5. XSS Prevention ✅**

```blade
{{-- Blade auto-escaping --}}
{{ $user->name }}           {{-- Safe --}}
{{ $product->description }} {{-- Escaped --}}
```

### **6. SQL Injection Prevention ✅**

```php
// Eloquent ORM với parameter binding
Cart::where('user_id', auth()->id())->get();
Order::where('id', $id)->where('user_id', auth()->id())->first();
```

---

## 🧪 **TESTING**

### **Feature Tests:**

```bash
tests/Feature/Auth/
├── AuthenticationTest.php
├── EmailVerificationTest.php
└── RegistrationTest.php
```

### **Run Tests:**

```bash
# Chạy tất cả tests
php artisan test

# Chạy specific test
php artisan test --filter AuthenticationTest
```

---

## 🚀 **DEPLOYMENT**

### **Production Setup:**

```bash
# Optimize for production
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Environment setup
APP_ENV=production
APP_DEBUG=false
```

### **Recommended Platforms:**

-   **Railway** - Modern platform với MySQL support
-   **Heroku** - Popular PaaS platform
-   **DigitalOcean** - VPS hosting
-   **Aiven** - Cloud database service

---

## 📊 **KẾT LUẬN**

### **Hoàn thành 100% yêu cầu bài tập:**

✅ **Laravel Framework** - Laravel 12.x với cấu trúc MVC
✅ **03+ Objects** - User, Product, Cart, Order, Category, OrderItem
✅ **Authentication** - Laravel Breeze với đầy đủ tính năng
✅ **CRUD Operations** - Cart và Order management hoàn chỉnh
✅ **Security Features** - CSRF, XSS, Validation, Auth, Session
✅ **Eloquent Migration** - Database structure hoàn chỉnh với relationships
✅ **README Documentation** - Chi tiết và comprehensive

### **Điểm mạnh của dự án:**

-   🏗️ **Clean Architecture**: MVC structure rõ ràng
-   🔒 **Security First**: Comprehensive security measures
-   🎨 **Modern UI**: Responsive design với TailwindCSS
-   📱 **User Experience**: Intuitive shopping flow
-   🛡️ **Error Handling**: Proper validation và error messages
-   📝 **Code Quality**: Well-documented và maintainable

### **Demo Accounts:**

```
Admin: admin@example.com / password
Test User: test@example.com / password
```

---

## 📞 **THÔNG TIN LIÊN HỆ**

**👤 Developer:** Nguyễn Quốc Thành
**📧 Email:** [Thêm email]
**🔗 GitHub:** [https://github.com/nqthanhhh](https://github.com/nqthanhhh)
**📱 Phone:** [Thêm số điện thoại]

---

## 📄 **LICENSE**

Dự án được phát hành dưới [MIT License](https://opensource.org/licenses/MIT).

---

<p align="center">
  <strong>🎂 Sweet Cake Shop - Made with ❤️ using Laravel</strong><br>
  <em>Bài tập giữa kỳ - Lập trình Web</em>
</p>

# 🎂 Website Bán Bánh Kem - Laravel Project

## 👤 Thông tin sinh viên

-   **Họ và tên:** Nguyễn Quốc Thành
-   **Mã sinh viên:** 23010038
-   **Môn học:** Lập trình Web - Bài tập giữa kỳ

---

## 📌 Mục tiêu dự án

Xây dựng một ứng dụng web bán bánh kem trực tuyến với các chức năng:

-   Hiển thị sản phẩm bánh kem theo danh mục
-   Cho phép khách hàng đặt hàng thông qua giỏ hàng
-   Xác thực người dùng (Laravel Breeze)
-   Quản lý sản phẩm (CRUD)
-   Bảo mật và xác thực dữ liệu
-   Sử dụng MySQL Cloud (Aiven) và Eloquent để quản lý dữ liệu

---

## 🛠️ Công nghệ sử dụng

-   **Ngôn ngữ:** PHP, Blade, HTML, CSS
-   **Framework:** Laravel 11
-   **Xác thực:** Laravel Breeze (Auth)
-   **Database:** MySQL
-   **Quản lý phiên:** Session, Cookie
-   **Bảo mật:** CSRF, XSS, Validation, Authorization
-   **Source Control:** Git & GitHub

---

## 🧱 Các đối tượng chính (Models)

-   `Product`: Bánh kem (id, tên, mô tả, giá, hình ảnh, loại bánh)
-   `Customer`: Người dùng có thể đăng ký, đăng nhập, mua hàng
-   `CartItem`: Quan hệ giữa Customer và Product, chứa số lượng và giá

---

## 🔐 Tính năng bảo mật áp dụng

-   CSRF protection cho các form
-   Validation đầu vào ở cả client và server
-   Chống XSS bằng `{{ }}` và HTML Purifier (nếu có)
-   Xác thực người dùng và phân quyền với middleware
-   Sử dụng session và cookies an toàn
-   Truy vấn qua Eloquent ORM tránh SQL injection

---

## 🔄 CRUD Được triển khai

-   ✅ CRUD cho `CartItem` (thêm vào giỏ, cập nhật số lượng, xoá)
-   ✅ CRUD nội bộ Laravel Breeze cho `User` (Register/Login)

---

## ☁️ Cơ sở dữ liệu

-   Hệ quản trị CSDL: MySQL trên localhostAdmin\*
-   Migrations được tạo bằng **Eloquent**
-   Seeders có thể tạo dữ liệu mẫu bánh kem để demo

---

## 🚀 Cài đặt & chạy thử

```bash
git clone https://github.com/nqthanhhh/Cake_shop.git
cd cake-shop
composer install
cp .env.example .env
php artisan key:generate

# Kết nối Aiven MySQL (chỉnh DB trong .env)
php artisan migrate --seed

php artisan serve

```
