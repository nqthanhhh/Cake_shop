{{-- @extends('admin.layouts')

@section('title', 'Đăng nhập Admin')

@php($hideSidebar = true)

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100 w-full">
    <div class="w-full max-w-md bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Đăng nhập Admin</h2>
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-semibold" for="email">Email</label>
                <input id="email" type="email" name="email" required autofocus class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-6">
                <label class="block mb-1 font-semibold" for="password">Mật khẩu</label>
                <input id="password" type="password" name="password" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Đăng nhập</button>
        </form>
        @if(session('error'))
            <div class="mt-4 text-red-600 text-center">{{ session('error') }}</div>
        @endif
    </div>
</div>
@endsection --}}
