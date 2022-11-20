<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'src'       => 'public/images.png',
            'link'      => 'http://localhost/',
            'is_public' => true,
        ];
    }
}
