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
                'code' => 'MJ5S',
                'name' => 'MINI JELLY 5S @72BAG',
                'category_id' => '1',
                'unit_id' => '1',
                'rack_capacity' => '50',
                'weight' => '6060',
                'total_weight' => '303000',
            ],
            [
                'code' => 'MJ15S',
                'name' => 'MINI JELLY 15S @24BAG',
                'category_id' => '1',
                'unit_id' => '1',
                'rack_capacity' => '54',
                'weight' => '5960',
                'total_weight' => '321840',
            ],
            [
                'code' => 'MJ25S',
                'name' => 'MINI JELLY 25S @12BAG',
                'category_id' => '1',
                'unit_id' => '1',
                'rack_capacity' => '75',
                'weight' => '4940',
                'total_weight' => '370500',
            ],
            [
                'code' => 'MJ10KG',
                'name' => 'MINI JELLY MIX 10KG',
                'category_id' => '1',
                'unit_id' => '1',
                'rack_capacity' => '55',
                'weight' => '10650',
                'total_weight' => '585750',
            ]
        ]);
    }
}
