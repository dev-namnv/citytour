<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('vi_VN');

        // Admin
        DB::table('users')->insert([
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => 'admin@gmail.com',
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date(),
            'address' => $faker->address,
            'password' => Hash::make('admin'),
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'points' => rand(),
            'role' => 1
        ]);

        // User
        DB::table('users')->insert([
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => 'user@gmail.com',
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date(),
            'address' => $faker->address,
            'password' => Hash::make('user'),
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'points' => rand(),
            'role' => 0
        ]);
    }
}
