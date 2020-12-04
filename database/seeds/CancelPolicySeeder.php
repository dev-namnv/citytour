<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CancelPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metadata = [
            0 => [
                'name' => 'Trong vòng 10 ngày trước khi tour xuất phát',
                'date' => 10,
                'refunds' => 100,
                'behavioral_points_deduction' => 0
            ],
            1 => [
                'name' => 'Trong vòng 7 ngày trước khi tour xuất phát',
                'date' => 7,
                'refunds' => 100,
                'behavioral_points_deduction' => 50
            ],
            2 => [
                'name' => 'Trong vòng 5 ngày trước khi tour xuất phát',
                'date' => 5,
                'refunds' => 75,
                'behavioral_points_deduction' => 100
            ],
            3 => [
                'name' => 'Trong vòng 3 ngày trước khi tour xuất phát',
                'date' => 3,
                'refunds' => 50,
                'behavioral_points_deduction' => 200
            ],
            4 => [
                'name' => 'Trong vòng 1 ngày trước khi tour xuất phát',
                'date' => 1,
                'refunds' => 0,
                'behavioral_points_deduction' => 400
            ]
        ];
        foreach ($metadata as $data) {
            DB::table('cancel_policies')->insertGetId($data);
        }
    }
}
