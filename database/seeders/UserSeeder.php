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
                'username' => 'admin',
                'role_id' => '1',
                'avatar' => '',
                'password' => Hash::make('admin123'),
            ],
            [
                'name' => 'Guest',
                'email' => 'guest@guest',
                'username' => 'guest',
                'role_id' => '2',
                'avatar' => '',
                'password' => Hash::make('guest123'),
            ]
        ]);
    }
}
