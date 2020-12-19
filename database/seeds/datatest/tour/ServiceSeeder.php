<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('vi_VN');

        $services = [
            0 => ['name' => 'Viện bảo tàng', 'icon' => 'icon_set_1_icon-4'],
            1 => ['name' => 'Khả năng tiếp cận', 'icon' => 'icon_set_1_icon-13'],
            2 => ['name' => 'Cho phép vật nuôi', 'icon' => 'icon_set_1_icon-22'],
            3 => ['name' => 'Hướng dẫn âm thanh', 'icon' => 'icon_set_1_icon-97'],
            4 => ['name' => 'Hướng dẫn viên du lịch', 'icon' => 'icon_set_1_icon-29'],
            5 => ['name' => 'Plasma TV', 'icon' => 'icon_set_2_icon-116'],
            6 => ['name' => 'TV Plasma', 'icon' => 'icon_set_1_icon-86'],
            7 => ['name' => 'Thăm dò ý kiến', 'icon' => 'icon_set_2_icon-110'],
            8 => ['name' => 'Bữa ăn sáng', 'icon' => 'icon_set_1_icon-59'],
            9 => ['name' => 'Đậu xe', 'icon' => 'icon_set_1_icon-27'],
            10 => ['name' => 'Đón khách tại khách sạn', 'icon' => 'icon_set_1_icon-6'],
            11 => ['name' => 'Hành lý lớn', 'icon' => 'icon_set_1_icon-33'],
            12 => ['name' => 'Pizza / Ý', 'icon' => 'icon_set_3_restaurant-1'],
            13 => ['name' => 'Khu vực không hút thuốc lá', 'icon' => 'icon_set_1_icon-47']
        ];

        foreach ($services as $item) {
            DB::table('services')->insert([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'icon' => $item['icon'],
                'description' => $faker->realText(50)
            ]);
        }
    }
}
