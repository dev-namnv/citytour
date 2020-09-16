<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('vi_VN');

        for ($i = 0; $i < 50; $i++) {
            $name = 'Sản phẩm số ' . $i;
            $origin_price = rand(1, 999999);
            $id = DB::table('products')->insertGetId([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . rand(9, 999),
                'sku' => strtoupper(uniqid()),
                'image' => 'https://via.placeholder.com/950x375?text=Product ' . $i,
                'origin_price' => $origin_price,
                'price' => $origin_price - $origin_price/rand(1, 10),
                'quantity' => rand(0, 1000),
                'intro' => $faker->realText(),
                'description' => $faker->realText(),
                'active' => rand(0, 1),
                'partner_id' => DB::table('partners')->inRandomOrder()->first('id')->id ?? 1,
            ]);

            // Product reviews
            for ($j = 0; $j < 8; $j++) {
                DB::table('product_reviews')->insert([
                   'content' => $faker->realText(),
                    'star' => rand(0, 5),
                    'active' => rand(0, 1),
                    'user_id' => DB::table('users')->inRandomOrder()->first('id')->id,
                    'product_id' => $id
                ]);
            }

            // Product categories
            for ($h = 0; $h < 3; $h++) {
                DB::table('relation_product_category')->insert([
                    'product_id' => $id,
                    'category_id' => DB::table('product_categories')->inRandomOrder()->first()->id
                ]);
            }
        }
    }
}
