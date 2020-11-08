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
            0 => ['name' => 'Museum', 'icon' => 'icon_set_1_icon-4'],
            1 => ['name' => 'Accessibility', 'icon' => 'icon_set_1_icon-13'],
            2 => ['name' => 'Pet allowed', 'icon' => 'icon_set_1_icon-22'],
            3 => ['name' => 'Audio guide', 'icon' => 'icon_set_1_icon-97'],
            4 => ['name' => 'Tour guide', 'icon' => 'icon_set_1_icon-29'],
            5 => ['name' => 'Plasma TV', 'icon' => 'icon_set_2_icon-116'],
            6 => ['name' => 'Free Wifi', 'icon' => 'icon_set_1_icon-86'],
            7 => ['name' => 'Poll', 'icon' => 'icon_set_2_icon-110'],
            8 => ['name' => 'Breakfast', 'icon' => 'icon_set_1_icon-59'],
            9 => ['name' => 'Parking', 'icon' => 'icon_set_1_icon-27'],
            10 => ['name' => 'Hotel Pick up', 'icon' => 'icon_set_1_icon-6'],
            11 => ['name' => 'Large baggage', 'icon' => 'icon_set_1_icon-33'],
            12 => ['name' => 'Pizza /Italian', 'icon' => 'icon_set_3_restaurant-1'],
            13 => ['name' => 'No smoking area', 'icon' => 'icon_set_1_icon-47']
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
