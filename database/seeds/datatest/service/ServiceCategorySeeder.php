<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('vi_VN');

        $icons = [
            0 => ['name' => 'Tham quan thành phố', 'icon' => 'icon_set_1_icon-3'],
            1 => ['name' => 'Tham quan bảo tàng', 'icon' => 'icon_set_1_icon-4'],
            2 => ['name' => 'Tòa nhà lịch sử', 'icon' => 'icon_set_1_icon-44'],
            3 => ['name' => 'Những tour đi bộ', 'icon' => 'icon_set_1_icon-37'],
            4 => ['name' => 'Ăn uống', 'icon' => 'icon_set_1_icon-14'],
            5 => ['name' => 'Wifi miễn phí', 'icon' => 'icon_set_1_icon-86'],
            6 => ['name' => 'Churces', 'icon' => 'icon_set_1_icon-43'],
            7 => ['name' => 'Chuyến tham quan đường chân trời ', 'icon' => 'icon_set_1_icon-28']
        ];

        foreach ($icons as $icon) {
            $name = $faker->name;
            DB::table('service_categories')->insert([
                'name' => $icon['name'],
                'slug' => Str::slug($name),
                'icon' => $icon['icon'],
                'description' => $faker->realText(50),
                'sort_order' => rand(0, 20)
            ]);
        }
    }
}
