<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('distributors')->insert([
            [
                'code' => 'KDUSBY',
                'name' => 'KDU SURABAYA',
                'created_by' => '1'
            ],
            [
                'code' => 'KDUMDN',
                'name' => 'KDU MADIUN',
                'created_by' => '1'
            ],
        ]);
    }
}
