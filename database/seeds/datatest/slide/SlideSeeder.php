<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('vi_VN');

        for ($i = 0; $i < 30; $i++) {
            DB::table('sliders')->insert([
                'title' => $faker->title,
                'heading' => $faker->text(15),
                'image' => 'http://lorempixel.com/1450/750/city/',
                'description' => $faker->realText(),
                'active' => rand(0, 1)
            ]);
        }
    }
}
