<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalSeeder extends Seeder
{
    public function run()
    {
        DB::table('rentals')->insert([
            [
                'user_id' => 1,
                'car_id' => 1,
                'start_date' => '2024-07-01',
                'end_date' => '2024-07-07',
                'total_cost' => 2100000,
                'returned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'car_id' => 2,
                'start_date' => '2024-07-05',
                'end_date' => '2024-07-10',
                'total_cost' => 2500000,
                'returned' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'car_id' => 3,
                'start_date' => '2024-07-10',
                'end_date' => '2024-07-15',
                'total_cost' => 1750000,
                'returned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
