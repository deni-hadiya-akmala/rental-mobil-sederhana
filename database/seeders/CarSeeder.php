<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    public function run()
    {
        DB::table('cars')->insert([
            [
                'brand' => 'Toyota',
                'model' => 'Avanza',
                'plate_number' => 'B 1234 CD',
                'rental_price' => 300000,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Honda',
                'model' => 'CR-V',
                'plate_number' => 'B 5678 EF',
                'rental_price' => 500000,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Suzuki',
                'model' => 'Ertiga',
                'plate_number' => 'B 9101 GH',
                'rental_price' => 350000,
                'is_available' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
