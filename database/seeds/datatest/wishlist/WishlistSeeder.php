<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            $type = rand(1, 2) * 10;
            if ($type === TYPE_SERVICE) {
                DB::table('wishlist_service')->insert([
                    'service_id' => DB::table('services')->inRandomOrder()->first('id')->id,
                    'user_id' => $user->id
                ]);
            } else {
                DB::table('wishlist_product')->insert([
                    'product_id' => DB::table('products')->inRandomOrder()->first('id')->id,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
