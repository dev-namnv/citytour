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
            'last_name' => '',
            'email' => 'admin@gmail.com',
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date(),
            'address' => $faker->address,
            'password' => Hash::make('admin'),
            'avatar' => 'https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/users/300_23.jpg',
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'role' => ADMIN
        ]);

        // Guide
        DB::table('users')->insert([
            'username' => 'anhpnph07905',
            'first_name' => 'Ngọc Anh',
            'last_name' => 'Phạm',
            'email' => 'anhpnph07905@fpt.edu.vn',
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date(),
            'address' => $faker->address,
            'password' => Hash::make('anhpnph07905'),
            'avatar' => 'https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/users/300_13.jpg',
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'role' => GUIDE
        ]);
        DB::table('users')->insert([
            'username' => 'namnvph08169',
            'first_name' => 'Văn Nam',
            'last_name' => 'Nguyễn',
            'email' => 'namnvph08169@fpt.edu.vn',
            'phone' => '+84966 531 163',
            'birthday' => '2000/01/16',
            'address' => '2/2/66 Nguyên Xá, Minh Khai, Bắc Từ Liêm, Hà Nội',
            'password' => Hash::make('namnvph08169'),
            'avatar' => 'https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/users/300_12.jpg',
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'role' => GUIDE
        ]);
        DB::table('users')->insert([
            'username' => 'dangvdph07886',
            'first_name' => 'Duy Đăng',
            'last_name' => 'Vũ',
            'email' => 'dangvdph07886@fpt.edu.vn',
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date(),
            'address' => $faker->address,
            'password' => Hash::make('dangvdph07886'),
            'avatar' => 'https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/users/300_15.jpg',
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'role' => GUIDE
        ]);
        DB::table('users')->insert([
            'username' => 'duongnh09034',
            'first_name' => 'Hải Dương',
            'last_name' => 'Nguyễn',
            'email' => 'duongnh09034@fpt.edu.vn',
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date(),
            'address' => $faker->address,
            'password' => Hash::make('duongnh09034'),
            'avatar' => 'https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/users/300_21.jpg',
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'role' => GUIDE
        ]);
        DB::table('users')->insert([
            'username' => 'quangtvph08049',
            'first_name' => 'Văn Quang',
            'last_name' => 'Trần',
            'email' => 'quangtvph08049@fpt.edu.vn',
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date(),
            'address' => $faker->address,
            'password' => Hash::make('quangtvph08049'),
            'avatar' => 'https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/users/300_22.jpg',
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'role' => GUIDE
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
            'avatar' => 'https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/users/300_18.jpg',
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'role' => USER
        ]);
        DB::table('users')->insert([
            'username' => 'user1',
            'first_name' => 'User1',
            'last_name' => $faker->lastName,
            'email' => 'user1@gmail.com',
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date(),
            'address' => $faker->address,
            'password' => Hash::make('user1'),
            'avatar' => 'https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/users/300_14.jpg',
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'role' => USER
        ]);
        DB::table('users')->insert([
            'username' => 'user2',
            'first_name' => 'User2',
            'last_name' => $faker->lastName,
            'email' => 'user2@gmail.com',
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date(),
            'address' => $faker->address,
            'password' => Hash::make('user2'),
            'avatar' => 'https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/users/300_13.jpg',
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'role' => USER
        ]);
        DB::table('users')->insert([
            'username' => 'user3',
            'first_name' => 'User3',
            'last_name' => $faker->lastName,
            'email' => 'user3@gmail.com',
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date(),
            'address' => $faker->address,
            'password' => Hash::make('user3'),
            'avatar' => 'https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/users/300_18.jpg',
            'city' => $faker->city,
            'zipcode' => $faker->postcode,
            'country' => $faker->country,
            'role' => USER
        ]);
    }
}
