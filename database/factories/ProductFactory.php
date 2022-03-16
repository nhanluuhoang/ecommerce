<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'  => Category::query()->inRandomOrder()->first()->id,
            'title'        => $this->faker->realText($maxNbChars = 50),
            'descriptions' => $this->faker->realText($maxNbChars = 250),
            'thumbnails'   => 'public/images.png',
            'price'        => $this->faker->randomFloat($nbMaxDecimals = null, $min = 0, $max = null),
            'sku'          => $this->faker->numerify('000000000'),
            'quantity'        => $this->faker->numberBetween($min = 1000, $max = 9000),
        ];
    }
}
