<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParnetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('vi_VN');

        for ($i = 0; $i < 10; $i++) {
            $name = 'Đối tác số ' . $i;
            $id_partner = DB::table('partners')->insertGetId([
                'name' => $name,
                'email' => $faker->email,
                'sku' => strtoupper(uniqid()),
            ]);

            // Staff
            for ($j = 0; $j < 5; $j++) {
                // Create user record
                $id_staff = DB::table('users')->insertGetId([
                    'username' => $faker->userName,
                    'first_name' => 'Nhân viên của ' . $name,
                    'last_name' => '',
                    'email' => $faker->email,
                    'role' => EMPLOYEE,
                    'password' => Hash::make('staff')
                ]);

                // Create staff record
                DB::table('staffs')->insert([
                    'partner_id' => $id_partner,
                    'user_id' => $id_staff
                ]);
            }
        }
    }
}
