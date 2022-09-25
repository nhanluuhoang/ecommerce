<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name(),
            'email'     => $this->faker->unique()->safeEmail(),
            'phone'     => $this->faker->e164PhoneNumber,
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
        ];
    }
}
