<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'full_name' => 'super-admin',
            'email'     => config('ecommerce.mail_from_address'),
            'phone'     => '1000000000',
            'password'  => 'password',
            'address'   => [
                [
                    'address'     => '39 Nguyễn Thị Diệu, Phường 6, Quận 3, TP.Hồ Chí Minh',
                    'province_id' => 1013,
                    'district_id' => 1158,
                    'ward_id'     => 1165,
                    'default'     => true
                ]
            ]
        ]);

        User::query()->create([
            'full_name' => 'manager',
            'email'     => 'manager@gmail.com',
            'phone'     => '2000000000',
            'password'  => 'password',
            'address'   => [
                [
                    'address'     => '39 Nguyễn Thị Diệu, Phường 6, Quận 3, TP.Hồ Chí Minh',
                    'province_id' => 1013,
                    'district_id' => 1158,
                    'ward_id'     => 1165,
                    'default'     => true
                ]
            ]
        ]);

        User::factory(10)->create();
    }
}
