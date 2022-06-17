<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            [
                'code' => 'MJL5S',
                'name' => 'MINI JELLY 5S @72BAG',
                'category_id' => '1',
                'unit_id' => '1',
                'rack_capacity' => '50',
                'weight' => '6060',
            ],
            [
                'code' => 'MJL15S',
                'name' => 'MINI JELLY 15S @24BAG',
                'category_id' => '1',
                'unit_id' => '1',
                'rack_capacity' => '54',
                'weight' => '5960',
            ],
            [
                'code' => 'MJL25S',
                'name' => 'MINI JELLY 25S @12BAG',
                'category_id' => '1',
                'unit_id' => '1',
                'rack_capacity' => '75',
                'weight' => '4940',
            ],
            [
                'code' => 'MJLMIX10KG',
                'name' => 'MINI JELLY MIX 10KG',
                'category_id' => '1',
                'unit_id' => '1',
                'rack_capacity' => '55',
                'weight' => '10650',
            ]
        ]);
    }
}
