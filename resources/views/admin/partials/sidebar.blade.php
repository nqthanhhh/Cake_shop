<aside class="w-64 bg-white shadow-md h-screen sticky top-0">
    <div class="p-6 font-bold text-xl border-b">Admin Panel</div>
    <nav class="mt-6">
        <ul>
            <li class="mb-2">
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-6 hover:bg-gray-200 rounded transition">Trang tổng quan</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.users') }}" class="block py-2 px-6 hover:bg-gray-200 rounded transition">Quản lý tài khoản</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.orders') }}" class="block py-2 px-6 hover:bg-gray-200 rounded transition">Xác nhận đơn hàng</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.products') }}" class="block py-2 px-6 hover:bg-gray-200 rounded transition">Quản lý sản phẩm</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.contacts') }}" class="block py-2 px-6 hover:bg-gray-200 rounded transition">Tin nhắn từ khách</a>
            </li>
        </ul>
    </nav>
</aside>
