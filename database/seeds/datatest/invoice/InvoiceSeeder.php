<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
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
            $user_id = DB::table('users')->inRandomOrder()->first('id')->id;
            $cost = rand(100000, 100000000);
            $vat_cost = $cost/rand(10, 15);

            $id = DB::table('invoices')->insertGetId([
                'name' => 'Hóa đơn số ' . $i,
                'sku' => strtoupper(uniqid()),
                'sub_cost' => $cost,
                'vat_cost' => $vat_cost,
                'total_cost' => $cost + $vat_cost,
                'address' => $faker->address,
                'email' => $faker->email,
                'message' => $faker->realText(),
                'payment_type' => CREDIT_CARD,
                'payment_status' => rand(0, 1),
                'status' => rand(0, 1),
                'user_id' => $user_id
            ]);

            // User logs
            DB::table('user_logs')->insert([
                'title' => 'Thanh toán đơn hàng số ' . $i,
                'points' => ($cost + $vat_cost)/10,
                'user_id' => $user_id
            ]);

            // Invoice detail
            for ($j = 0; $j < 5; $j++) {
                $service_id = DB::table('tours')->inRandomOrder()->first('id')->id;
                DB::table('invoice_detail')->insert([
                    'invoice_id' => $id,
                    'adult_count' => rand(1, 5),
                    'child_count' => rand(0, 3),
                    'adult_price' => rand(100000, 100000000),
                    'child_price' => rand(10000, 10000000)
                ]);

                DB::table('tour_logs')->insert([
                    'tour_id' => $service_id,
                    'user_id' => $user_id
                ]);
            }
        }
    }
}
