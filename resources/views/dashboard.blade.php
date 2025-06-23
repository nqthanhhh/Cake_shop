@extends('front.layout.master')

@section('title', 'Dashboard')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
    <div class="container mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-8 shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Welcome Header -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border border-gray-100">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-2xl font-bold">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Xin chào, {{ $user->name }}!</h1>
                    <p class="text-gray-600 mt-1">Chào mừng bạn đến với Sweet Cake Dashboard</p>
                </div>
            </div>
        </div>

        <!-- Profile Information Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-primary to-secondary p-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Thông tin cá nhân
                </h2>
            </div>

            <div class="p-8">
                <div class="space-y-6">
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center mb-3">
                            <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <p class="text-sm font-medium text-gray-500">Họ và tên</p>
                        </div>
                        <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center mb-3">
                            <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                        </div>
                        <p class="text-lg font-semibold text-gray-800">{{ $user->email }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center mb-3">
                            <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <p class="text-sm font-medium text-gray-500">Số điện thoại</p>
                        </div>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $user->phone ?? 'Chưa cập nhật' }}
                            @if(!$user->phone)
                                <span class="text-sm text-amber-600 ml-2">(Cần cập nhật)</span>
                            @endif
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center mb-3">
                            <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-sm font-medium text-gray-500">Địa chỉ</p>
                        </div>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $user->address ?? 'Chưa cập nhật' }}
                            @if(!$user->address)
                                <span class="text-sm text-amber-600 ml-2">(Cần cập nhật)</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="mt-8">
                    <button onclick="window.location.href='{{ route('profile.edit') }}'"
                            class="w-full bg-gradient-to-r from-primary to-secondary text-white px-8 py-4 rounded-xl hover:shadow-lg transform hover:-translate-y-1 transition-all duration-200 font-semibold flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Cập nhật thông tin
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
