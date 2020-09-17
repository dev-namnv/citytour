<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('vi_VN');

        for ($i = 0; $i < 200; $i++) {
            $name = 'Tag ' . $i;
            DB::table('article_tags')->insert([
               'name' => $name,
               'slug' => Str::slug($name) . '-' . rand(9, 9999)
            ]);
        }
    }
}
