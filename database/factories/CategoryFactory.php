<?php

namespace Database\Factories;

use App\Enums\CategoryTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'      => $this->faker->realText($maxNbChars = 10),
            'sort_order' => $this->faker->randomNumber(1),
            'is_public'  => $this->faker->randomElement([true, false]),
            'type'       => $this->faker->randomElement(CategoryTypeEnum::getValues())
        ];
    }

}
