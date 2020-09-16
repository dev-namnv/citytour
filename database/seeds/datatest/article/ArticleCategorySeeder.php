<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 40; $i++) {
            $name = 'Chuyên mục ' . $i;
            DB::table('article_categories')->insertGetId([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . rand(1, 100),
                'active' => rand(0, 1)
            ]);
        }
    }
}
