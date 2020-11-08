<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            DB::table('wishlists')->insert([
                'tour_id' => DB::table('services')->inRandomOrder()->first('id')->id,
                'user_id' => $user->id
            ]);
        }
    }
}
