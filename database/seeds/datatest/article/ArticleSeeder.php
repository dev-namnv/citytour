<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
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
            $name = 'Bài viết số ' . $i;
            $id = DB::table('articles')->insertGetId([
                'title' => $name,
                'heading' => $name,
                'slug' => Str::slug($name) . '-' . rand(99, 9999),
                'content' => $faker->text(),
                'image' => 'http://lorempixel.com/950/375/city/',
                'user_id' => DB::table('users')->inRandomOrder()->first('id')->id
            ]);

            // Relation article & category
            for ($j = 0; $j < 3; $j++) {
                DB::table('relation_article_category')->insert([
                    'article_id' => $id,
                    'category_id' => DB::table('article_categories')->inRandomOrder()->first('id')->id
                ]);
            }

            // Relation article & tag
            for ($h = 0; $h < 5; $h++) {
                DB::table('relation_article_tag')->insert([
                   'article_id' => $id,
                   'tag_id' => DB::table('article_tags')->inRandomOrder()->first('id')->id
                ]);
            }

            // Comment article
            for ($l = 0; $l < 10; $l++) {
                DB::table('article_comments')->insert([
                    'content' => $faker->text(),
                    'active' => rand(0, 1),
                    'user_id' => DB::table('users')->inRandomOrder()->first('id')->id,
                    'article_id' => $id
                ]);
            }
        }
    }
}
