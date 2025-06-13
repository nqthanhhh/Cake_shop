<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Lấy thông tin người dùng đăng nhập
        $orders = Order::where('user_id', $user->id)->latest()->get(); // Lấy đơn hàng của người dùng, sắp xếp mới nhất

        return view('dashboard', compact('user', 'orders')); // Truyền cả user và orders
    }
}
