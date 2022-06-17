<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'code' => 'FG',
                'name' => 'FINISH GOODS',
                'created_by' => '1'
            ],
            [
                'code' => 'RM',
                'name' => 'RAW MATERIAL',
                'created_by' => '1'
            ],
        ]);
    }
}
