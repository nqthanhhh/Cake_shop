<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Contact;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['is_admin'] = 1;
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
        return back()->with('error', 'Sai thông tin đăng nhập hoặc không có quyền admin!');
    }

    public function dashboard()
    {
        $productCount = Product::count();
        $orderCount = Order::count();
        $userCount = User::count();
        return view('admin.dashboard', compact('productCount', 'orderCount', 'userCount'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
    public function users()
    {
        $users = \App\Models\User::all();
        return view('admin.user.users', compact('users'));
    }
    public function deleteUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        // Không cho phép admin tự xoá chính mình hoặc xoá admin khác qua giao diện này
        if ($user->is_admin) {
            return redirect()->route('admin.users')->with('error', 'Không thể xoá tài khoản admin!');
        }
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Xoá tài khoản thành công!');
    }
    public function userDetail($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $orders = \App\Models\Order::where('user_id', $id)->latest()->get();
        return view('admin.user.user_detail', compact('user', 'orders'));
    }
    public function userOrder($orderId)
    {
        $order = \App\Models\Order::with('orderItems')->findOrFail($orderId);
        return view('admin.user.user_order', compact('order'));
    }
    public function orders()
    {
        $orders = \App\Models\Order::latest()->get();
        return view('admin.orders', compact('orders'));
    }
    public function confirmOrder($orderId)
    {
        $order = \App\Models\Order::findOrFail($orderId);
        $order->status = 'confirmed';
        $order->save();
        return redirect()->back()->with('success', 'Đơn hàng đã được xác nhận!');
    }
    public function rejectOrder($orderId)
    {
        $order = \App\Models\Order::findOrFail($orderId);
        $order->status = 'rejected';
        $order->save();
        return redirect()->back()->with('success', 'Đơn hàng đã bị từ chối!');
    }
    public function products()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Xoá sản phẩm thành công!');
    }
    public function createProduct()
    {
        return view('admin.product.create');
    }
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'detailed_description' => 'nullable|string',
            'price' => 'required|numeric|min:1000', // Bỏ giới hạn max
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required|integer|exists:categories,id',
            'stock' => 'required|integer|min:0',
        ]);
        $imagePath = $request->file('image')->store('img', 'public');
        $product = new \App\Models\Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->detailed_description = $request->detailed_description;
        $product->price = $request->price;
        $product->image = 'storage/' . $imagePath;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->is_featured = true; // Sản phẩm mới sẽ là nổi bật, hiển thị ở trang home
        $product->save();
        return redirect()->route('admin.products')->with('success', 'Thêm sản phẩm thành công!');
    }
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'detailed_description' => 'nullable|string',
            'price' => 'required|numeric|min:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required|integer|exists:categories,id',
            'stock' => 'required|integer|min:0',
        ]);
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->detailed_description = $request->detailed_description;
        $product->price = $request->price;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img', 'public');
            $product->image = 'storage/' . $imagePath;
        }
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->save();
        return redirect()->route('admin.products')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function contacts()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts.index', compact('contacts'));
    }
}
