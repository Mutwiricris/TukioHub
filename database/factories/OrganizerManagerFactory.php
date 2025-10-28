<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganizerManager>
 */
class OrganizerManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'email_verified_at' => now(),
            'phone_verified_at' => fake()->optional(0.7)->dateTime(),
            'password' => bcrypt('password'), // Default password for testing
            'is_active' => true,
            'last_login_at' => fake()->optional(0.8)->dateTimeBetween('-1 month', 'now'),
            'timezone' => fake()->randomElement(['Africa/Nairobi', 'Africa/Lagos', 'Africa/Cairo']),
            'language' => fake()->randomElement(['en', 'sw']),
            'two_factor_enabled' => fake()->boolean(20), // 20% chance of having 2FA enabled
        ];
    }
}
