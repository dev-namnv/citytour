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
        for ($i = 0; $i < 20; $i++) {
            $name = $faker->name;
            DB::table('service_categories')->insert([
                'name' => $name,
                'slug' => Str::slug($name),
                'sort_order' => rand(0, 20)
            ]);
        }
    }
}
