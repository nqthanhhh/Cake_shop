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
                'detailed_description' => 'Bánh Dâu Tươi được làm từ những nguyên liệu tươi ngon nhất, với lớp kem mịn màng và dâu tây tươi mọng. Đây là sự lựa chọn hoàn hảo cho những dịp đặc biệt như sinh nhật, lễ kỷ niệm.',
                'price' => 320000,
                'image' => 'img/product1.jpg',
                'category_id' => 1,
                'stock' => 10,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Socola Đặc Biệt',
                'description' => 'Bánh socola đậm đà với lớp ganache mềm mịn',
                'detailed_description' => 'Bánh Socola Đặc Biệt mang đến hương vị socola đậm đà, kết hợp với lớp ganache mềm mịn tan chảy trong miệng. Đây là món quà tuyệt vời cho những tín đồ yêu thích socola.',
                'price' => 350000,
                'image' => 'img/product2.jpg',
                'category_id' => 1,
                'stock' => 15,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Tiramisu',
                'description' => 'Bánh tiramisu hương vị cà phê Ý truyền thống',
                'detailed_description' => 'Bánh Tiramisu được làm từ lớp bánh ladyfinger mềm mịn, hòa quyện với hương vị cà phê và rượu nhẹ, phủ trên là lớp kem mascarpone béo ngậy.',
                'price' => 280000,
                'image' => 'img/product3.jpg',
                'category_id' => 1,
                'stock' => 20,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Việt Quất',
                'description' => 'Bánh phô mai mềm mịn với lớp việt quất tươi ngon',
                'detailed_description' => 'Bánh Việt Quất là sự kết hợp hoàn hảo giữa lớp phô mai mềm mịn và lớp việt quất tươi mọng, mang đến hương vị ngọt ngào và thanh mát.',
                'price' => 300000,
                'image' => 'img/product4.jpg',
                'category_id' => 1,
                'stock' => 12,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Trà Xanh',
                'description' => 'Bánh kem trà xanh matcha thơm ngon, thanh mát',
                'detailed_description' => 'Bánh Trà Xanh được làm từ bột matcha nguyên chất, mang đến hương vị thanh mát và lớp kem mềm mịn, phù hợp cho những ai yêu thích trà xanh.',
                'price' => 290000,
                'image' => 'img/product5.jpg',
                'category_id' => 1,
                'stock' => 18,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Red Velvet',
                'description' => 'Bánh red velvet với lớp kem phô mai mềm mịn',
                'detailed_description' => 'Bánh Red Velvet nổi bật với màu đỏ quyến rũ, kết hợp cùng lớp kem phô mai béo ngậy, là lựa chọn hoàn hảo cho các buổi tiệc sang trọng.',
                'price' => 330000,
                'image' => 'img/product6.jpg',
                'category_id' => 1,
                'stock' => 8,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Tart Trái Cây',
                'description' => 'Bánh tart với các loại trái cây tươi theo mùa',
                'detailed_description' => 'Bánh Tart Trái Cây được làm từ lớp vỏ tart giòn tan, kết hợp với kem tươi và các loại trái cây tươi ngon theo mùa.',
                'price' => 270000,
                'image' => 'img/product7.jpg',
                'category_id' => 1,
                'stock' => 25,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Mousse Xoài',
                'description' => 'Bánh mousse xoài mềm mịn với lớp xoài tươi bên trên',
                'detailed_description' => 'Bánh Mousse Xoài mang đến hương vị nhiệt đới với lớp mousse mềm mịn và lớp xoài tươi mát, là món tráng miệng hoàn hảo cho mùa hè.',
                'price' => 310000,
                'image' => 'img/product8.jpg',
                'category_id' => 1,
                'stock' => 16,
                'is_featured' => true
            ],
            // Bánh Cưới
            [
                'name' => 'Bánh Cưới Sang Trọng',
                'description' => 'Bánh cưới thiết kế đặc biệt cho ngày trọng đại.',
                'detailed_description' => 'Bánh cưới với thiết kế sang trọng, phù hợp cho các buổi lễ cưới.',
                'price' => 500000,
                'image' => 'img/product9.jpg',
                'category_id' => 2, // Gán vào danh mục Bánh Cưới
                'stock' => 5,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Cưới Hoa Quả Cao Cấp',
                'description' => 'Bánh cưới cao cấp với thiết kế tinh tế và sang trọng.',
                'detailed_description' => 'Bánh cưới Luxury được làm từ những nguyên liệu cao cấp nhất, với thiết kế tinh tế và sang trọng, phù hợp cho các buổi lễ cưới đẳng cấp.',
                'price' => 800000,
                'image' => 'img/product10.jpg',
                'category_id' => 2, // Gán vào danh mục Bánh Cưới
                'stock' => 3,
                'is_featured' => true
            ],
            // Bánh Theo Chủ Đề
            [
                'name' => 'Bánh Chủ Đề hoạt hình',
                'description' => 'Bánh sinh nhật được thiết kế theo chủ đề yêu thích của bạn.',
                'detailed_description' => 'Bánh Sinh Nhật Theo Chủ Đề cho phép bạn tùy chỉnh thiết kế theo sở thích cá nhân, mang đến sự độc đáo và cá tính cho ngày sinh nhật của bạn.',
                'price' => 400000,
                'image' => 'img/product11.jpg',
                'category_id' => 3, // Gán vào danh mục Bánh Theo Chủ Đề
                'stock' => 10,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Chủ Đề Thể Thao',
                'description' => 'Bánh sinh nhật theo chủ đề thể thao yêu thích.',
                'detailed_description' => 'Bánh Chủ Đề Thể Thao được thiết kế đặc biệt cho những người yêu thích thể thao, với hình ảnh và màu sắc phù hợp với môn thể thao yêu thích của bạn.',
                'price' => 450000,
                'image' => 'img/product12.jpg',
                'category_id' => 3, // Gán vào danh mục Bánh Theo Chủ Đề
                'stock' => 8,
                'is_featured' => true
            ],
            // Bánh Theo Dịp
            [
                'name' => 'Bánh Giáng Sinh',
                'description' => 'Bánh ngọt ngào cho mùa Giáng Sinh.',
                'detailed_description' => 'Bánh Giáng Sinh được trang trí với các hình ảnh và màu sắc đặc trưng của mùa lễ hội, mang đến không khí ấm áp và vui tươi cho gia đình bạn.',
                'price' => 360000,
                'image' => 'img/product13.jpg',
                'category_id' => 4, // Gán vào danh mục Bánh Theo Dị    p
                'stock' => 20,
                'is_featured' => true
            ],
            [
                'name' => 'Bánh Tết Nguyên Đán',
                'description' => 'Bánh truyền thống cho dịp Tết Nguyên Đán.',
                'detailed_description' => 'Bánh Tết Nguyên Đán mang đậm hương vị truyền thống của ngày Tết, với các nguyên liệu đặc trưng và thiết kế đẹp mắt, là món quà ý nghĩa cho gia đình và bạn bè.',
                'price' => 380000,
                'image' => 'img/product14.jpg',
                'category_id' => 4, // Gán vào danh mục Bánh Theo Dịp
                'stock' => 15,
                'is_featured' => true
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
