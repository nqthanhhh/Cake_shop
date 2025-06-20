@extends('admin.layouts')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <main class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Thêm sản phẩm mới</h1>
        <div class="bg-white p-6 rounded shadow max-w-xl">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Tên sản phẩm</label>
                    <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Mô tả ngắn</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Mô tả chi tiết</label>
                    <textarea name="detailed_description" class="w-full border rounded px-3 py-2"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Giá</label>
                    <input type="number" name="price" class="w-full border rounded px-3 py-2" min="0" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Ảnh sản phẩm</label>
                    <input type="file" name="image" class="w-full border rounded px-3 py-2" accept="image/*" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Danh mục</label>
                    <select name="category_id" class="w-full border rounded px-3 py-2" required>
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Tồn kho</label>
                    <input type="number" name="stock" class="w-full border rounded px-3 py-2" min="0" required>
                </div>
                <button type="submit" class="bg-pink-500 text-white px-6 py-2 rounded hover:bg-pink-700 transition-colors font-semibold flex items-center">
                    <i class="fas fa-plus mr-2"></i> Thêm sản phẩm
                </button>
                <a href="{{ route('admin.products') }}" class="ml-4 text-gray-600 hover:underline">Quay lại</a>
            </form>
        </div>
    </main>
</div>
@endsection
