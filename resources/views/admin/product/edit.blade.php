@extends('admin.layouts')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <main class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Chỉnh sửa sản phẩm</h1>
        <div class="bg-white p-6 rounded shadow max-w-xl">
            @if ($errors->any())
                <div class="mb-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Tên sản phẩm</label>
                    <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name', $product->name) }}" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Mô tả ngắn</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2" required>{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Mô tả chi tiết</label>
                    <textarea name="detailed_description" class="w-full border rounded px-3 py-2">{{ old('detailed_description', $product->detailed_description) }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Giá</label>
                    <input type="number" name="price" class="w-full border rounded px-3 py-2" min="0" value="{{ old('price', $product->price) }}" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Ảnh sản phẩm</label>
                    <input type="file" name="image" class="w-full border rounded px-3 py-2" accept="image/*">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="Ảnh hiện tại" class="mt-2 w-24 h-24 object-cover rounded">
                    @endif
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Danh mục</label>
                    <select name="category_id" class="w-full border rounded px-3 py-2" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Tồn kho</label>
                    <input type="number" name="stock" class="w-full border rounded px-3 py-2" min="0" value="{{ old('stock', $product->stock) }}" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-700 transition-colors font-semibold flex items-center">
                    <i class="fas fa-save mr-2"></i> Lưu thay đổi
                </button>
                <a href="{{ route('admin.products') }}" class="ml-4 text-gray-600 hover:underline">Quay lại</a>
            </form>
        </div>
    </main>
</div>
@endsection
