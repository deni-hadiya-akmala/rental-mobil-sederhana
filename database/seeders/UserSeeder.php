<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'fullname' => 'User One',
            'username' => 'admin',
            'phone' => '081388071014',
            'address' => 'Jl. ningnong, sukapura, dayeuhkolot, kab. Bandung',
            'email' => 'userone@example.com',
            'password' => Hash::make('12345'),
        ]);

        User::create([
            'fullname' => 'User Two',
            'username' => 'usertwo',
            'phone' => '087888071014',
            'address' => 'Jl. pariaman, sukapura, dayeuhkolot, kab. Bandung',
            'email' => 'usertwo@example.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'fullname' => 'User Three',
            'username' => 'userthree',
            'email' => 'userthree@example.com',
            'password' => Hash::make('12345678'),
            'phone' => '087888071014',
            'address' => 'Jl. ciburial, sukapura, dayeuhkolot, kab. Bandung',
        ]);
        // User::factory()->count(5)->create();
    }
}
