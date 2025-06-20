@extends('admin.layouts')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    {{-- <!-- Sidebar -->
    @include('admin.partials.sidebar') --}}
    <!-- Main Content -->
    <main class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Tổng quan</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Sản phẩm -->
            <div class="bg-white p-6 rounded shadow">
                <div class="text-gray-500">Tổng sản phẩm</div>
                <div class="text-3xl font-bold">{{ isset($productCount) ? $productCount : 0  }}</div>
            </div>
            <!-- Đơn hàng -->
            <div class="bg-white p-6 rounded shadow">
                <div class="text-gray-500">Tổng đơn hàng</div>
                <div class="text-3xl font-bold">{{ isset($orderCount) ? $orderCount : 0}}</div>
            </div>
            <!-- Người dùng -->
            <div class="bg-white p-6 rounded shadow">
                <div class="text-gray-500">Tổng người dùng</div>
                <div class="text-3xl font-bold">{{ isset($userCount) ? $userCount : 0  }}</div>
            </div>
        </div>
        <!-- Nội dung động khác có thể thêm ở đây -->
    </main>
</div>
@endsection
