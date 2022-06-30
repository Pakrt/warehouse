<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('racks')->insert([
            [
                'area' => 'Produk Luar',
                'row' => '6',
                'name' => 'A',
                'qty' => '60',
                'status' => 'on',
            ],
            [
                'area' => 'Produk Lokal',
                'row' => '6',
                'name' => 'B',
                'qty' => '60',
                'status' => 'on',
            ]
        ]);
    }
}
