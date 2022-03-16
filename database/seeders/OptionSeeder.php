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
                'option_name' => 'Màu sắc',
            ],
            [
                'option_name' => 'Kích thước',
            ],
            [
                'product_id' => 'Thể tích',
            ],
            [
                'product_id' => 'Mùi hương',
            ],
            [
                'product_id' => 'Chất liệu',
            ],
        ]);
    }
}
