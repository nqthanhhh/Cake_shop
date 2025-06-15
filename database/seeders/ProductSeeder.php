<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Bánh Dâu Tươi',
                'description' => 'Bánh kem tươi ngon với lớp dâu tây tươi phủ trên bề mặt',
                'price' => 320000,
                'image' => 'img/product1.jpg',
                'category_id' => 1,
                'stock' => 10,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Socola Đặc Biệt',
                'description' => 'Bánh socola đậm đà với lớp ganache mềm mịn',
                'price' => 350000,
                'image' => 'img/product2.jpg',
                'category_id' => 1,
                'stock' => 15,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Tiramisu',
                'description' => 'Bánh tiramisu hương vị cà phê Ý truyền thống',
                'price' => 280000,
                'image' => 'img/product3.jpg',
                'category_id' => 1,
                'stock' => 20,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Việt Quất',
                'description' => 'Bánh phô mai mềm mịn với lớp việt quất tươi ngon',
                'price' => 300000,
                'image' => 'img/product4.jpg',
                'category_id' => 1,
                'stock' => 12,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Trà Xanh',
                'description' => 'Bánh kem trà xanh matcha thơm ngon, thanh mát',
                'price' => 290000,
                'image' => 'img/product5.jpg',
                'category_id' => 1,
                'stock' => 18,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Red Velvet',
                'description' => 'Bánh red velvet với lớp kem phô mai mềm mịn',
                'price' => 330000,
                'image' => 'img/product6.jpg',
                'category_id' => 1,
                'stock' => 8,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Tart Trái Cây',
                'description' => 'Bánh tart với các loại trái cây tươi theo mùa',
                'price' => 270000,
                'image' => 'img/product7.jpg',
                'category_id' => 1,
                'stock' => 25,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Mousse Xoài',
                'description' => 'Bánh mousse xoài mềm mịn với lớp xoài tươi bên trên',
                'price' => 310000,
                'image' => 'img/product8.jpg',
                'category_id' => 1,
                'stock' => 16,
                'is_featured' => true
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
