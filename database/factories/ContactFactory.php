<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'mobile' => fake()->e164PhoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'date_of_birth' => fake()->dateTimeBetween('-50 years', '-18 years'),
            'city_id' => fake()->randomElement([4886, 4785, 4927]),
            'gender' => fake()->randomElement(['m', 'f']),
            'origin' => fake()->randomElement(['waitlist', 'reservation', 'review', 'vip', 'loyalty']),
            'is_vip' => fake()->boolean(),
            'send_notifications' => fake()->boolean(),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
