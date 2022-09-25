<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            [
                'value' => 'Màu sắc',
            ],
            [
                'value' => 'Kích thước',
            ],
            [
                'value' => 'Thể tích',
            ],
            [
                'value' => 'Mùi hương',
            ],
            [
                'value' => 'Chất liệu',
            ],
        ]);
    }
}
