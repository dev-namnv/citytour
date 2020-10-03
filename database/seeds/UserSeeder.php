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
        DB::table('users')->insertGetId([
            'username' => 'admin',
            'first_name' => 'Admin',
            'last_name' => $faker->lastName,
            'email' => 'admin@gmail.com',
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date(),
            'address' => $faker->address,
            'password' => Hash::make('admin'),
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'role' => ADMIN
        ]);

        // Editor
        DB::table('users')->insert([
            'username' => 'editor',
            'first_name' => 'Editor',
            'last_name' => $faker->lastName,
            'email' => 'editor@gmail.com',
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date(),
            'address' => $faker->address,
            'password' => Hash::make('editor'),
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'role' => EDITOR
        ]);

        // User
        DB::table('users')->insert([
            'username' => 'user',
            'first_name' => 'User',
            'last_name' => $faker->lastName,
            'email' => 'user@gmail.com',
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date(),
            'address' => $faker->address,
            'password' => Hash::make('user'),
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'role' => USER
        ]);
    }
}
