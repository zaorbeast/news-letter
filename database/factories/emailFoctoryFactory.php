<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class emailFoctoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email'=>$this->faker->text(100),
            'key'=>$this->faker->text(255)
        ];
    }
}
