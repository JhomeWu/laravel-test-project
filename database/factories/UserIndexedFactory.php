<?php

namespace Database\Factories;

use App\Models\UserIndexed;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserIndexedFactory extends Factory
{
    protected $model = UserIndexed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'register_at' => $this->faker->dateTimeBetween('-30 years', $endDate = 'now'),
        ];
    }
}
