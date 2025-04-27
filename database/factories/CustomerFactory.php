<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'mobile'=> $this->faker->phoneNumber(11),
            'address' => $this->faker->address,
            'details' => $this->faker->streetName,
            'previous_balance'=> $this->faker->numberBetween(111,222),
        ];
    }
}
