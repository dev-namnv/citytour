<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('vi_VN');

        for ($i = 0; $i < 5; $i++) {
            $title = $faker->title;
            for ($j = 0; $j < 10; $j++) {
                DB::table('faqs')->insert([
                    'title' => $title,
                    'heading' => $faker->text(20),
                    'content' => $faker->realText()
                ]);
            }
        }
    }
}
