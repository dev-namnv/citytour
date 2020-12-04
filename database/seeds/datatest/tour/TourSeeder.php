<?php

use App\Models\Tour;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('vi_VN');

        $services = DB::table('services')->get();

        for ($i = 0; $i < 50; $i++) {
            $name = 'Tour số ' . $i;
            $tour = new Tour;

            $tour->name = $name;
            $tour->slug = Str::slug($name) . '-' . rand(9, 999);
            $tour->address = $faker->address;
            $tour->description = $faker->realText();
            $tour->thumbnail = 'http://lorempixel.com/800/533/city/';
            $tour->banner = 'http://lorempixel.com/1400/470/city/';
            $tour->adult_price = rand(100000, 10000000);
            $tour->child_price = rand(100000, 10000000);
            $tour->active = rand(1, 0);
            $tour->guide_id = DB::table('users')->where('role', '=', GUIDE)->inRandomOrder()->first('id')->id;
            $tour->category_id = DB::table('categories')->inRandomOrder()->first('id')->id;

            $tour->save();

            $id = $tour->id;

            // Schedule
            for ($m = 0; $m < 5; $m++) {
                DB::table('schedules')->insert([
                    'description' => $faker->realText(),
                    'tour_id' => $id
                ]);
            }

            // Batch
            for ($n = 1; $n < 13; $n++) {
                DB::table('batches')->insert([
                    'batch' => '2020-0'.$n.'-0'.$n,
                    'tour_id' => $id
                ]);
            }

            // Relation service facilities
            foreach ($services as $service) {
                DB::table('relation_tour_service')->insert([
                    'tour_id' => $id,
                    'service_id' => $service->id
                ]);
            }

            // Albums image
            for ($j = 0; $j < 10; $j++) {
                DB::table('albums')->insert([
                    'image' => 'http://lorempixel.com/950/375/city/',
                    'sort_order' => $j,
                    'tour_id' => $id
                ]);
            }

            // Review
            for ($h = 0; $h < 10; $h++) {
                DB::table('reviews')->insert([
                    'content' => $faker->realText(),
                    'star' => rand(0, 5),
                    'active' => rand(0, 1),
                    'user_id' => DB::table('users')->inRandomOrder()->first('id')->id,
                    'tour_id' => $id
                ]);
            }
        }
    }
}
