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
            'password'  => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'address'   => [
                'address_1' => [
                    'address'    => '39 Nguyễn Thị Diệu, Phường 6, Quận 3, TP.Hồ Chí Minh',
                    'address_id' => '1165-1158-1013',
                    'default'    => true
                ]
            ]
        ];
    }
}
