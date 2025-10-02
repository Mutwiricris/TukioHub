<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'event_id' => Event::factory(),
            'ticket_id' => Ticket::factory(),
            'reference_number' => 'TKT-' . strtoupper(\Illuminate\Support\Str::random(10)),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $this->faker->randomElement(['not_scanned', 'scanned', 'expired', 'cancelled']),
            'scanned_at' => $this->faker->optional()->dateTimeThisYear(),
            'purchased_at' => $this->faker->dateTimeThisYear(),
            'payment_reference' => 'PAY-' . strtoupper(\Illuminate\Support\Str::random(10)),
        ];
    }
}
