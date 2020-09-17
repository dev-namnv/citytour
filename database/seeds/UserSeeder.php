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
        $admin_id = DB::table('users')->insertGetId([
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

        $travelo_id = DB::table('partners')->insertGetId([
            'name' => 'Cty TNHH City Tours',
            'email' => 'info@citytour.asia',
            'avatar' => 'https://firebasestorage.googleapis.com/v0/b/travelo-4e9da.appspot.com/o/images%2Flogo%2Flogo.png?alt=media&token=84fac77c-887d-4823-9a6b-9a66113393d9',
            'sku' => 'city-tour'
        ]);

        DB::table('staffs')->insert([
            'partner_id' => $travelo_id,
            'user_id' => $admin_id
        ]);
    }
}
