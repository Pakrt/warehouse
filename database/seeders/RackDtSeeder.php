<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RackDtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 3; $i++) {
            for ($j=1; $j < 61; $j++) { 
                DB::table('rack_dt')->insert([
                    [
                        'rack_id' => $i,
                        'number' => $j,
                        'is_load' => '0',
                    ],
                ]);
            } 
        }
    }
}
