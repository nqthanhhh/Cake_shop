<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Bánh Sinh Nhật',
                'description' => 'Những chiếc bánh đặc biệt cho ngày đặc biệt của bạn',
                'image' => 'img/catego1.jpg',
                'slug' => Str::slug('Bánh Sinh Nhật')
            ],
            [
                'name' => 'Bánh Cưới',
                'description' => 'Bánh cưới sang trọng cho ngày trọng đại',
                'image' => 'img/catego2.jpg',
                'slug' => Str::slug('Bánh Cưới')
            ],
            [
                'name' => 'Bánh Theo Chủ Đề',
                'description' => 'Bánh được thiết kế theo ý tưởng của bạn',
                'image' => 'img/catego3.jpg',
                'slug' => Str::slug('Bánh Theo Chủ Đề')
            ],
            [
                'name' => 'Bánh Theo Dịp',
                'description' => 'Bánh cho các dịp lễ đặc biệt trong năm',
                'image' => 'img/catego4.jpg',
                'slug' => Str::slug('Bánh Theo Dịp')
            ]
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
