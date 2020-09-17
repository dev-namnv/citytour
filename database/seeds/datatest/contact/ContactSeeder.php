<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContactSeeder extends Seeder
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
            DB::table('contacts')->insert([
                'subject' => $faker->realText(50),
                'full_name' => $faker->name,
                'email' => $faker->email,
                'message' => $faker->realText(),
                'geoip' => $faker->countryCode,
                'status' => rand(0, 6) * 10
            ]);
        }
    }
}
