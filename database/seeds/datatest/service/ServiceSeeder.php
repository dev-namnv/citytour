<?php

use App\Models\Service;
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

        $schedule = '{
            "monday": {
                "name": "Monday",
                "time": "10.00 - 17.30"
            },
            "tuesday": {
                "name": "Tuesday",
                "time": "09.00 - 17.30"
            },
            "wednesday": {
                "name": "Wednesday",
                "time": "09.10 - 17.30"
            },
            "thursday": {
                "name": "Thursday",
                "time": "Closed"
            },
            "friday": {
                "name": "Friday",
                "time": "09.00 - 17.30"
            },
            "saturday": {
                "name": "Saturday",
                "time": "09.00 - 17.30"
            },
            "sunday": {
                "name": "Sunday",
                "time": "09.00 - 17.30"
            }
        }';

        $facilities = DB::table('facilities')->get();

        for ($i = 0; $i < 50; $i++) {
            $name = 'Dịch vụ số ' . $i;

            $service = new Service;

            $service->name = $name;
            $service->slug = Str::slug($name) . '-' . rand(9, 999);
            $service->address = $faker->address;
            $service->description = $faker->realText();
            $service->content = $faker->realText();
            $service->schedule = $schedule;
            $service->price = rand(10000, 10000000);
            $service->type = SERVICE_TOUR;
            $service->service_category_id = DB::table('service_categories')->inRandomOrder()->first('id')->id;
            $service->active = rand(1, 0);

            $service->save();

            $id = $service->id;

            // Relation service facilities
            foreach ($facilities as $facility) {
                DB::table('relation_service_facility')->insert([
                    'service_id' => $id,
                    'facility_id' => $facility->id
                ]);
            }

            // Albums image
            for ($j = 0; $j < 10; $j++) {
                DB::table('albums')->insert([
                    'image' => 'https://via.placeholder.com/950x375?text=Album ' . $j,
                    'service_id' => $id
                ]);
            }

            // Review
            for ($h = 0; $h < 10; $h++) {
                DB::table('reviews')->insert([
                    'content' => $faker->realText(),
                    'star' => rand(0, 5),
                    'active' => rand(0, 1),
                    'user_id' => DB::table('users')->inRandomOrder()->first('id')->id,
                    'service_id' => $id
                ]);
            }
        }
    }
}
