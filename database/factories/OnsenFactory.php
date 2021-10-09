<?php

namespace Database\Factories;

use App\Models\Onsen;
use Illuminate\Database\Eloquent\Factories\Factory;

class OnsenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Onsen::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber()
        ];
    }
}
