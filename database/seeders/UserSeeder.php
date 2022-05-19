<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@admin',
                'password' => Hash::make('admin123'),
            ],
            [
                'name' => 'Guest',
                'email' => 'guest@guest',
                'password' => Hash::make('guest123'),
            ]
        ]);
    }
}
