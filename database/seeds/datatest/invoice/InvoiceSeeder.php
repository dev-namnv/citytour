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
            $tour = DB::table('tours')->inRandomOrder()->first();
            $user = DB::table('users')->inRandomOrder()->first(['id']);
            $cost = rand(100000, 100000000);
            $vat_cost = $cost/rand(10, 15);
            $deposit_cost = $cost/30 + $vat_cost;
            $start_date = ['2020-10-12','2020-10-23','2020-11-01','2020-11-04','2020-11-10'];
            $id = DB::table('invoices')->insertGetId([
                'sku' => strtoupper(uniqid()),

                'start_date' => $start_date[array_rand($start_date)],
                'adult_count' => rand(1, 5),
                'child_count' => rand(0, 3),
                'sub_cost' => $cost,
                'vat_cost' => $vat_cost,
                'total_cost' => $cost + $vat_cost,
                'payment_type' => CREDIT_CARD,
                'deposit_cost' => $deposit_cost,

                'customer_name' => $faker->name,
                'customer_address' => $faker->address,
                'customer_email' => $faker->email,
                'customer_phone' => $faker->phoneNumber,
                'customer_message' => $faker->realText(),
                'status' => rand(0, 6),

                'user_id' => $user->id,
                'guide_id' => $tour->user_id,
                'tour_id' => $tour->id,
            ]);

            // User logs
            DB::table('user_logs')->insert([
                'title' => 'Thanh toán đơn hàng số ' . $i,
                'points' => ($cost + $vat_cost)/10,
                'user_id' => $tour->user_id,
            ]);

            // Invoice detail
            for ($j = 0; $j < 5; $j++) {
                $schedules = DB::table('schedules')->where('tour_id',$tour->id)->get('description');
                DB::table('invoice_detail')->insert([
                    'invoice_id' => $id,
                    'name' => $tour->name,
                    'address' => $tour->address,
                    'thumbnail' => $tour->thumbnail,
                    'adult_price' => $tour->adult_price,
                    'child_price' => $tour->child_price,
                    'schedule' => json_encode($schedules),
                ]);

                DB::table('tour_logs')->insert([
                    'tour_id' => $tour->id,
                    'user_id' => $tour->user_id,
                ]);
            }
        }
    }
}
