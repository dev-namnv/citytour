<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 40; $i++) {
            $name = 'Danh mục số ' . $i;
            DB::table('product_categories')->insert([
               'name' => $name,
                'slug' => Str::slug($name) . '-' . rand(9, 999),
                'active' => rand(0, 1)
            ]);
        }
    }
}
