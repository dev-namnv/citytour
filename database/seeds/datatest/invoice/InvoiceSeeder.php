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
            $type_invoice = rand(1, 2) * 10;

            $user_id = DB::table('users')->inRandomOrder()->first('id')->id;
            $cost = rand(100000, 100000000);
            $ship_cost = rand(10000, 100000);
            $vat_cost = $cost/rand(10, 15);

            $id = DB::table('invoices')->insertGetId([
                'name' => 'Hóa đơn số ' . $i,
                'type' => rand(1, 2) * 10,
                'sku' => strtoupper(uniqid()),
                'sub_cost' => $cost,
                'vat_cost' => $vat_cost,
                'ship_cost' => $ship_cost,
                'total_cost' => $cost + $vat_cost + $ship_cost,
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
                'type' => $type_invoice,
                'points' => ($cost + $vat_cost + $ship_cost)/10,
                'user_id' => $user_id
            ]);

            // Invoice detail
            for ($j = 0; $j < 5; $j++) {
                if ($type_invoice === TYPE_SERVICE) {
                    $service_id = DB::table('services')->inRandomOrder()->first('id')->id;
                    DB::table('invoice_service_detail')->insert([
                        'amount_of_people' => rand(1, 4),
                        'service_id' => $service_id,
                        'invoice_id' => $id
                    ]);

                    DB::table('service_logs')->insert([
                        'service_id' => $service_id,
                        'user_id' => $user_id
                    ]);
                } else {
                    DB::table('invoice_product_detail')->insert([
                        'quantity' => rand(0, 4),
                        'product_id' => DB::table('products')->inRandomOrder()->first('id')->id,
                        'invoice_id' => $id
                    ]);
                }
            }
        }
    }
}
