<strong>🎂 Sweet Cake Shop - Made with ❤️ using Laravel</strong><br>
<em>Bài tập giữa kỳ - Lập trình Web</em>

---

## 📋 **THÔNG TIN DỰ ÁN**

**🎯 Tên bài tập:** Website Bán Bánh Kem với Laravel Framework
**🔗 Link Repository:** [https://github.com/nqthanhhh/Cake_shop.git](https://github.com/nqthanhhh/Cake_shop.git)

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

Dự án đã triển khai **9 đối tượng chính:**

| Model         | File Path                  | Chức năng                          |
| ------------- | -------------------------- | ---------------------------------- |
| **User**      | `app/Models/User.php`      | Quản lý người dùng, authentication |
| **Admin**     | `app/Models/Admin.php`     | Quản lý tài khoản admin            |
| **Product**   | `app/Models/Product.php`   | Quản lý sản phẩm bánh kem          |
| **Category**  | `app/Models/Category.php`  | Phân loại sản phẩm theo danh mục   |
| **Cart**      | `app/Models/Cart.php`      | Giỏ hàng người dùng                |
| **Order**     | `app/Models/Order.php`     | Đơn hàng                           |
| **OrderItem** | `app/Models/OrderItem.php` | Chi tiết đơn hàng                  |
| **Review**    | `app/Models/Review.php`    | Đánh giá sản phẩm                  |
| **Contact**   | `app/Models/Contact.php`   | Liên hệ từ khách hàng              |

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

**CRUD cho Product (Admin):**

-   **Create:** `AdminController@createProduct` - Thêm sản phẩm mới
-   **Read:** `AdminController@products` - Danh sách sản phẩm
-   **Update:** `AdminController@updateProduct` - Cập nhật sản phẩm
-   **Delete:** `AdminController@deleteProduct` - Xóa sản phẩm

```php
// Tạo sản phẩm mới
public function storeProduct(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:1000',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        'category_id' => 'required|integer|exists:categories,id',
        'stock' => 'required|integer|min:0',
    ]);

    $imagePath = $request->file('image')->store('img', 'public');
    Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'image' => 'storage/' . $imagePath,
        'category_id' => $request->category_id,
        'stock' => $request->stock,
        'is_featured' => true
    ]);
}
```

**CRUD cho Review (Đánh giá):**

-   **Create:** `ReviewController@store` - Thêm đánh giá
-   **Read:** Hiển thị trong trang sản phẩm
-   **Delete:** `AdminController@deleteReview` - Admin xóa đánh giá

```php
// Thêm đánh giá sản phẩm
public function store(Request $request) {
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string',
    ]);

    Review::create([
        'user_id' => auth()->id(),
        'product_id' => $request->product_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);
}
```

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

| Loại               | Công nghệ          | Phiên bản | Mô tả                  |
| ------------------ | ------------------ | --------- | ---------------------- |
| **Backend**        | Laravel            | 12.x      | PHP Framework chính    |
| **Authentication** | Laravel Breeze     | 2.3+      | Hệ thống xác thực      |
| **Database**       | MySQL/SQLite       | 8.0+      | Cơ sở dữ liệu          |
| **Frontend**       | Blade Templates    | -         | Template engine        |
| **CSS Framework**  | TailwindCSS        | 3.x       | Styling và responsive  |
| **Icons**          | RemixIcon          | 4.6.0     | Bộ icon UI             |
| **JavaScript**     | Vanilla JS         | ES6+      | Frontend interactions  |
| **File Storage**   | Laravel Storage    | -         | Upload và quản lý file |
| **Session**        | Laravel Session    | -         | Quản lý phiên          |
| **Validation**     | Laravel Validation | -         | Kiểm tra dữ liệu       |
| **Security**       | Laravel Security   | -         | CSRF, XSS protection   |

---

## 🏗️ **KIẾN TRÚC HỆ THỐNG**

### **📊 Sơ đồ kiến trúc tổng quan:**

<div align="center">
  <img src="images/system-architecture.png" alt="System Architecture" width="800">
  <p><em>Sơ đồ kiến trúc hệ thống MVC Laravel</em></p>
</div>

### **🔄 Sơ đồ Flow kiến trúc MVC:**

<div align="center">
  <img src="images/mvc-flow.png" alt="MVC Flow Diagram" width="800">
  <p><em>Luồng xử lý MVC trong Laravel</em></p>
</div>

### **🗃️ Database Relationships Diagram:**

<div align="center">
  <img src="images/database-schema.png" alt="Database Schema" width="800">
  <p><em>Sơ đồ quan hệ cơ sở dữ liệu</em></p>
</div>

### **🔐 Authentication & Authorization Flow:**

<div align="center">
  <img src="images/auth-flow.png" alt="Authentication Flow" width="800">
  <p><em>Luồng xác thực và phân quyền</em></p>
</div>

### **Controllers Architecture:**

**Frontend Controllers:**

-   `HomeController` - Trang chủ và danh sách sản phẩm nổi bật
-   `ProductController` - Chi tiết sản phẩm với reviews
-   `CategoryController` - Danh mục sản phẩm theo slug
-   `CartController` - Quản lý giỏ hàng (CRUD) với session/database
-   `OrderController` - Quản lý đơn hàng (CRUD) với order tracking
-   `UserDashboardController` - Dashboard người dùng với order history
-   `ReviewController` - Đánh giá sản phẩm với validation
-   `ContactController` - Liên hệ từ khách hàng
-   `Auth/*` - Các controller xác thực (Laravel Breeze)

**Admin Controllers:**

-   `Admin\AdminController` - Quản lý toàn bộ admin panel
-   `Admin\Auth\LoginController` - Đăng nhập admin riêng biệt với guard

**Middleware Layer:**

-   `AdminMiddleware` - Kiểm tra quyền admin
-   `Authenticate` - Kiểm tra đăng nhập
-   `VerifyCsrfToken` - CSRF Protection
-   `EncryptCookies` - Cookie encryption

### **Database Schema:**

```sql
users (id, name, email, password, phone, address, is_admin, timestamps)
admins (id, name, email, password, timestamps)
categories (id, name, description, image, slug, timestamps)
products (id, name, description, detailed_description, price, image, category_id, stock, is_featured, is_active, timestamps)
carts (id, user_id, product_id, quantity, timestamps)
orders (id, user_id, order_number, total_amount, status, payment_method, payment_status, customer_*, delivery_date, delivery_time, timestamps)
order_items (id, order_id, product_name, product_price, product_image, quantity, total_price, timestamps)
reviews (id, user_id, product_id, rating, comment, timestamps)
contacts (id, name, email, phone, message, timestamps)
```

---

## 🚀 **TÍNH NĂNG CHÍNH**

### **Frontend Features:**

-   🏠 **Trang chủ**: Hiển thị danh mục và sản phẩm nổi bật
-   🛍️ **Catalog**: Duyệt sản phẩm theo danh mục
-   🛒 **Shopping Cart**: Thêm/xóa/cập nhật sản phẩm
-   💳 **Checkout**: Form đặt hàng với validation
-   👤 **User Dashboard**: Quản lý đơn hàng cá nhân
-   ⭐ **Product Reviews**: Đánh giá và bình luận sản phẩm
-   📞 **Contact Form**: Liên hệ với cửa hàng
-   🔍 **Order Tracking**: Theo dõi trạng thái đơn hàng

### **Admin Panel Features:**

-   🔐 **Admin Authentication**: Hệ thống đăng nhập admin riêng
-   📊 **Dashboard**: Tổng quan số liệu (sản phẩm, đơn hàng, user)
-   👥 **User Management**: Quản lý tài khoản người dùng
-   📦 **Product Management**: CRUD sản phẩm với upload hình ảnh
-   🛒 **Order Management**: Xác nhận/từ chối/cập nhật trạng thái đơn hàng
-   ⭐ **Review Management**: Xóa đánh giá không phù hợp
-   📧 **Contact Management**: Xem và quản lý tin nhắn từ khách hàng

### **Backend Features:**

-   🔐 **Dual Authentication**: User & Admin guards riêng biệt
-   🛒 **Cart Management**: Lưu trữ trong database và session
-   📦 **Order Processing**: Xử lý đơn hàng với multiple status
-   💰 **Payment Methods**: COD, Bank Transfer (và demo MoMo/VNPay)
-   📧 **Contact System**: Thu thập và quản lý liên hệ
-   📊 **Dashboard Analytics**: Thống kê cho admin
-   🔄 **Order Status Flow**: pending → confirmed → shipping → delivered

### **Security Features:**

-   🔒 **CSRF Protection**: Tokens trên tất cả forms
-   ✅ **Input Validation**: Server-side validation
-   🛡️ **XSS Protection**: Blade templating auto-escape
-   🔐 **SQL Injection Prevention**: Eloquent ORM
-   👤 **Authentication**: Session-based auth với multi-guard
-   🔑 **Authorization**: Middleware và permission checks
-   🛡️ **Admin Guard**: Hệ thống xác thực admin riêng biệt
-   🔒 **Password Security**: Hash với bcrypt

**Admin Authorization Example:**

```php
// Config auth guards
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
],

// Admin middleware protection
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/orders', [AdminController::class, 'orders']);
});

// Admin login controller
public function login(Request $request) {
    if (Auth::guard('admin')->attempt($credentials)) {
        return redirect('/admin/dashboard');
    }
    return back()->with('error', 'Sai thông tin đăng nhập admin!');
}
```

---

## 🔗 **API ROUTES**

### **Authentication Routes:**

```php
GET  /login           - Trang đăng nhập user
POST /login           - Xử lý đăng nhập user
GET  /register        - Trang đăng ký
POST /register        - Xử lý đăng ký
POST /logout          - Đăng xuất user
GET  /forgot-password - Quên mật khẩu
POST /reset-password  - Reset mật khẩu
```

### **Admin Routes:**

```php
GET  /admin/login           - Trang đăng nhập admin
POST /admin/login           - Xử lý đăng nhập admin
POST /admin/logout          - Đăng xuất admin
GET  /admin/dashboard       - Dashboard admin
GET  /admin/users           - Quản lý user
GET  /admin/orders          - Quản lý đơn hàng
GET  /admin/products        - Quản lý sản phẩm
GET  /admin/contacts        - Quản lý liên hệ
```

### **Cart Management (Auth Required):**

```php
POST   /cart/add         - Thêm sản phẩm vào giỏ
GET    /cart             - Xem giỏ hàng
PUT    /cart/update      - Cập nhật số lượng
DELETE /cart/{id}        - Xóa sản phẩm
POST   /cart/delete-multiple - Xóa nhiều sản phẩm
GET    /cart/count       - Đếm số sản phẩm
```

### **Order Management (Auth Required):**

```php
GET  /checkout           - Trang thanh toán
POST /order              - Tạo đơn hàng
GET  /order/success/{id} - Trang thành công
GET  /order/{id}         - Chi tiết đơn hàng
GET  /order-tracking     - Theo dõi đơn hàng
POST /order/{id}/cancel  - Hủy đơn hàng
```

### **Review & Contact Routes:**

```php
POST /reviews            - Thêm đánh giá sản phẩm
POST /contact            - Gửi liên hệ
```

### **Public Routes:**

```php
GET /                    - Trang chủ
GET /product/{id}        - Chi tiết sản phẩm
GET /category/{slug}     - Sản phẩm theo danh mục
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

---

## 📊 **TỔNG KẾT VÀ ĐÁNH GIÁ DỰ ÁN**

### **✅ Hoàn thành yêu cầu bài tập:**

| Yêu cầu                  | Trạng thái    | Mô tả chi tiết                                                                    |
| ------------------------ | ------------- | --------------------------------------------------------------------------------- |
| **Laravel Framework**    | ✅ HOÀN THÀNH | Laravel 12.x với cấu trúc MVC hoàn chỉnh                                          |
| **03+ Objects**          | ✅ VƯỢT MỨC   | 9 Models: User, Admin, Product, Category, Cart, Order, OrderItem, Review, Contact |
| **Authentication**       | ✅ HOÀN THÀNH | Laravel Breeze + Admin Guard riêng biệt                                           |
| **CRUD Operations**      | ✅ VƯỢT MỨC   | Cart, Order, Product, Review với đầy đủ CRUD                                      |
| **Security Features**    | ✅ HOÀN THÀNH | CSRF, XSS, Validation, Auth, SQL Injection Prevention                             |
| **Eloquent Migration**   | ✅ HOÀN THÀNH | 12+ migrations với relationships phức tạp                                         |
| **README Documentation** | ✅ HOÀN THÀNH | Chi tiết và comprehensive với code examples                                       |

### **🌟 Điểm nổi bật của dự án:**

**1. Kiến trúc hệ thống:**

-   🏗️ **Clean MVC Architecture**: Tách biệt rõ ràng Model-View-Controller
-   🔐 **Multi-Guard Authentication**: User và Admin guards riêng biệt
-   � **Responsive Design**: UI hiện đại với TailwindCSS
-   🛡️ **Security First**: Áp dụng đầy đủ các biện pháp bảo mật

**2. Tính năng phong phú:**

-   🛒 **E-commerce Complete**: Từ browse sản phẩm đến checkout
-   👥 **User Management**: Dashboard cá nhân với order tracking
-   👨‍💼 **Admin Panel**: Quản lý toàn diện sản phẩm, đơn hàng, user
-   ⭐ **Review System**: Đánh giá và feedback sản phẩm
-   📞 **Contact System**: Thu thập và quản lý liên hệ khách hàng

**3. Chất lượng code:**

-   📝 **Well Documented**: Comment rõ ràng và README chi tiết
-   🔒 **Security Compliant**: Tuân thủ OWASP security guidelines
-   🧪 **Error Handling**: Validation và exception handling đầy đủ
-   � **Database Design**: Normalized với relationships hợp lý

**4. User Experience:**

-   🎨 **Modern UI/UX**: Giao diện thân thiện và intuitive
-   📱 **Mobile First**: Responsive trên mọi thiết bị
-   🚀 **Performance**: Optimized queries và caching
-   ♿ **Accessibility**: Semantic HTML và proper forms

### **📈 Số liệu thống kê chi tiết:**

| Thành phần           | Số lượng | Mô tả chi tiết                                                          |
| -------------------- | -------- | ----------------------------------------------------------------------- |
| **Models**           | 9        | User, Admin, Product, Category, Cart, Order, OrderItem, Review, Contact |
| **Controllers**      | 15+      | Frontend + Admin + Auth + Specialized controllers                       |
| **Migrations**       | 15+      | Bao gồm cả core và custom migrations                                    |
| **Seeders**          | 4        | DatabaseSeeder, AdminSeeder, CategorySeeder, ProductSeeder              |
| **Routes**           | 40+      | Public, Auth, Admin routes với middleware protection                    |
| **Views**            | 30+      | Frontend, Admin, Auth templates với layouts                             |
| **Middleware**       | 6+       | Auth, CSRF, Admin, Encrypt, Guest, Verified                             |
| **Guards**           | 2        | Web (users) và Admin (admins) authentication guards                     |
| **Validation Rules** | 20+      | Custom validation cho forms và API endpoints                            |
| **Database Tables**  | 12+      | Normalized schema với foreign key constraints                           |

### **🔄 System Flow Diagrams:**

**E-commerce Purchase Flow:**

<div align="center">
  <img src="images/purchase-flow.png" alt="Purchase Flow" width="800">
  <p><em>Quy trình mua hàng từ browse đến checkout</em></p>
</div>

**Admin Management Flow:**

<div align="center">
  <img src="images/admin-flow.png" alt="Admin Management Flow" width="800">
  <p><em>Luồng quản lý admin panel</em></p>
</div>

### **🚀 Advanced Technical Implementation:**

**Real-time Cart Count Updates:**

```javascript
// Frontend JavaScript - Real-time cart updates
function updateCartCount() {
    fetch("/cart/count")
        .then((response) => response.json())
        .then((data) => {
            document.getElementById("cartCount").textContent = data.count;
        });
}

// Auto-update after cart operations
document.addEventListener("cartUpdated", updateCartCount);
```

**Dynamic Address Selection:**

```javascript
// Location API integration
async function loadDistricts(provinceId) {
    const response = await fetch(`/api/districts/${provinceId}`);
    const districts = await response.json();
    updateSelectOptions("district", districts);
}

async function loadWards(districtId) {
    const response = await fetch(`/api/wards/${districtId}`);
    const wards = await response.json();
    updateSelectOptions("ward", wards);
}
```

**Order Status Tracking:**

```php
// Order tracking với timeline
public function getOrderTimeline()
{
    $timeline = [];

    $timeline[] = [
        'status' => 'pending',
        'label' => 'Đơn hàng đã được tạo',
        'timestamp' => $this->created_at,
        'completed' => true
    ];

    if ($this->status !== 'pending') {
        $timeline[] = [
            'status' => 'confirmed',
            'label' => 'Đơn hàng đã được xác nhận',
            'timestamp' => $this->updated_at,
            'completed' => in_array($this->status, ['confirmed', 'preparing', 'ready', 'delivered'])
        ];
    }

    // Add more timeline steps...

    return $timeline;
}
```

### **🔮 Khả năng mở rộng:**

**Tính năng có thể bổ sung:**

-   💳 **Payment Gateway**: Tích hợp thực tế MoMo, VNPay, PayPal
-   � **Email Notifications**: Thông báo qua email cho các sự kiện
-   📊 **Analytics**: Dashboard analytics chi tiết hơn
-   🔍 **Search & Filter**: Tìm kiếm và lọc sản phẩm nâng cao
-   📱 **Mobile App**: API cho mobile application
-   🌐 **Multi-language**: Hỗ trợ đa ngôn ngữ
-   📦 **Inventory Management**: Quản lý kho chi tiết hơn
-   🎁 **Coupon System**: Hệ thống mã giảm giá
-   📈 **Reporting**: Báo cáo doanh thu và analytics

---

## 📌 **MỘT SỐ HÌNH ẢNH DỰ ÁN**

---

## 🎨 **GIAO DIỆN NGƯỜI DÙNG**

### **Trang chủ và Navigation:**

<div align="center">
  <img src="screenshots/navbar-menu.png" alt="Navigation Bar" width="800">
  <p><em>Thanh navigation với menu danh mục</em></p>
</div>

<table>
<tr>
<td width="50%">
<img src="screenshots/category.png" alt="Category" width="100%">
<p align="center"><em>Danh mục sản phẩm</em></p>
</td>
<td width="50%">
<img src="screenshots/product-listing.png" alt="Featured Products" width="100%">
<p align="center"><em>Sản phẩm nổi bật</em></p>
</td>
</tr>
</table>

### **Trang chi tiết sản phẩm:**

<table>
<tr>
<td width="50%">
<img src="screenshots/product-info.png" alt="Product Info" width="100%">
<p align="center"><em>Thông tin và mô tả sản phẩm</em></p>
</td>
<td width="50%">
<img src="screenshots/review-form.png" alt="Review Form" width="100%">
<p align="center"><em>Form thêm đánh giá</em></p>
</td>
</tr>
</table>

---

## 🛒 **HỆ THỐNG GIỎ HÀNG & THANH TOÁN**

### **Giỏ hàng:**

<table>
<tr>
<td width="50%">
<img src="screenshots/cart-1.png" alt="Cart Items" width="100%">
<p align="center"><em>Giỏ hàng trống</em></p>
</td>
<td width="50%">
<img src="screenshots/cart-items.png" alt="Cart Summary" width="100%">
<p align="center"><em>Danh sách sản phẩm</em></p>
</td>
</tr>
</table>

### **Trang thanh toán:**

<table>
<tr>
<td width="50%">
<img src="screenshots/checkout.png" alt="checkout" width="100%">
<p align="center"><em>Trang checkout với form thông tin giao hàng</em></p>
</td>
<td width="50%">
<img src="screenshots/checkout-1.png" alt="checkout-1" width="100%">
<p align="center"><em>Trang dặt hàng thành công</em></p>
</td>
</tr>
</table>

---

## 👤 **AUTHENTICATION & USER DASHBOARD**

### **Đăng nhập & Đăng ký:**

<table>
<tr>
<td width="50%">
<img src="screenshots/login.png" alt="Login Form" width="100%">
<p align="center"><em>Form đăng nhập người dùng</em></p>
</td>
<td width="50%">
<img src="screenshots/register.png" alt="Register Form" width="100%">
<p align="center"><em>Form đăng ký tài khoản mới</em></p>
</td>
</tr>
</table>

### **Dashboard người dùng:**

<div align="center">
  <img src="screenshots/dashboard.png" alt="User Dashboard" width="800">
  <p><em>Dashboard cá nhân với thông tin tài khoản</em></p>
</div>

<table>
<tr>
<td width="33%">
<img src="screenshots/order.png" alt="Order History" width="100%">
<p align="center"><em>Theo dõi đơn hàng</em></p>
</td>
<td width="33%">
<img src="screenshots/profile-edit.png" alt="Profile Settings" width="100%">
<p align="center"><em>Cài đặt thông tin cá nhân</em></p>
</td>
<td width="33%">
<img src="screenshots/order-detail.png" alt="Order Details" width="100%">
<p align="center"><em>Chi tiết đơn hàng</em></p>
</td>
</tr>
</table>

---

## 👨‍💼 **ADMIN PANEL**

### **Admin Dashboard:**

<div align="center">
  <img src="screenshots/admin-dashboard-main.png" alt="Admin Dashboard" width="800">
  <p><em>Dashboard admin với thống kê tổng quan</em></p>
</div>

<!-- <table>
<tr>
<td width="33%">
<img src="screenshots/admin-stats-cards.png" alt="Admin Stats" width="100%">
<p align="center"><em>Thẻ thống kê nhanh</em></p>
</td>
<td width="33%">
<img src="screenshots/sales-chart-admin.png" alt="Sales Chart" width="100%">
<p align="center"><em>Biểu đồ doanh thu</em></p>
</td>
<td width="33%">
<img src="screenshots/recent-orders-admin.png" alt="Recent Orders" width="100%">
<p align="center"><em>Đơn hàng gần đây</em></p>
</td>
</tr>
</table> -->

### **Quản lý sản phẩm:**

<div align="center">
  <img src="screenshots/admin-products-list.png" alt="Admin Products List" width="800">
  <p><em>Danh sách sản phẩm trong admin panel</em></p>
</div>

<table>
<tr>
<td width="50%">
<img src="screenshots/admin-add-product.png" alt="Add Product Form" width="100%">
<p align="center"><em>Form thêm sản phẩm mới</em></p>
</td>
<td width="50%">
<img src="screenshots/admin-check-product.png" alt="Check Product Form" width="100%">
<p align="center"><em>Form chỉnh sửa sản phẩm</em></p>
</td>
</tr>
</table>

### **Quản lý đơn hàng:**

<table>
<tr>
<td width="50%">
<img src="screenshots/admin-order-details.png" alt="Admin Order Details" width="100%">
<p align="center"><em>Chi tiết đơn hàng trong admin</em></p>
</td>
<td width="50%">
<img src="screenshots/admin-order-list.png" alt="Order List" width="100%">
<p align="center"><em>Danh sát đơn hàng</em></p>
</td>
</tr>
</table>

### **Quản lý người dùng:**

<div align="center">
  <img src="screenshots/admin-users-list.png" alt="Users Management" width="800">
  <p><em>Danh sách người dùng và quản lý tài khoản</em></p>
</div>

<div align="center">
  <img src="screenshots/admin-user.png" alt="Users" width="800">
  <p><em>Chi tiết user</em></p>
</div>

---

## 📞 **CONTACT & SUPPORT**

<div align="center">
  <img src="screenshots/contact.png" alt="Contact" width="800">
  <p><em>Liên hệ với form gửi tin nhắn</em></p>
</div>

---

## 📞 **THÔNG TIN LIÊN HỆ & HỖ TRỢ**

### **👤 Thông tin Developer:**

**Tên:** Nguyễn Quốc Thành
**MSSV:** 23010038
**Lớp:** Lập trình Web - Bài tập giữa kỳ
**📧 Email:** [23010038@st.phenikaa-uni.edu.vn](mailto:23010038@st.phenikaa-uni.edu.vn)
**🔗 GitHub:** [https://github.com/nqthanhhh](https://github.com/nqthanhhh)
**📱 Phone:** [0862398217](tel:0862398217)

### **🔗 Links quan trọng:**

-   **Github-Repo:** [https://github.com/nqthanhhh/Cake_shop.git](https://github.com/nqthanhhh/Cake_shop.git)
-   **Github-Page:** [https://nqthanhhh.github.io/Cake_shop/](https://nqthanhhh.github.io/Cake_shop/)
-   **Demo:** Liên hệ để được cung cấp link demo
-   **Documentation:** README.md này chứa đầy đủ thông tin

### **📚 Tài liệu tham khảo:**

-   [Laravel Documentation](https://laravel.com/docs)
-   [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze)
-   [TailwindCSS](https://tailwindcss.com/docs)
-   [MySQL Documentation](https://dev.mysql.com/doc/)

### **🆘 Hỗ trợ và báo lỗi:**

Nếu bạn gặp vấn đề khi chạy dự án, vui lòng:

1. Kiểm tra lại các bước cài đặt trong README
2. Đảm bảo đã cài đặt đúng version PHP, Composer, Node.js
3. Kiểm tra file `.env` đã được cấu hình đúng
4. Liên hệ qua email hoặc GitHub Issues

**Made with ❤️ in Vietnam 🇻🇳**

---

<div align="center">
  <strong>🎂 Sweet Cake Shop - Where Every Bite Tells a Story 🎂</strong>
  <br>
  <em>© 2025 Nguyễn Quốc Thành. All rights reserved.</em>
</div>

---
