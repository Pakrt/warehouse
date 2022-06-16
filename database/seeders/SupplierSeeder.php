<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'code' => 'NPS',
                'name' => 'NIRAMAS PANDAAN SEJAHTERA',
                'created_by' => '1',
            ],
            [
                'code' => 'NU',
                'name' => 'NIRAMAS UTAMA',
                'created_by' => '1',
            ]
        ]);
    }
}
