<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\UserTicket;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTicketSeeder extends Seeder
{
    protected $faker;
    
    public function __construct()
    {
        $this->faker = Faker::create();
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = User::all();
        
        // Get all events with tickets
        $events = Event::with('tickets')->get();
        
        // Create 50 user tickets
        foreach (range(1, 50) as $i) {
            // Get a random user
            $user = $users->random();
            
            // Get a random event with tickets
            $event = $events->random();
            $ticket = $event->tickets->random();
            
            // Create a user ticket
            UserTicket::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'ticket_id' => $ticket->id,
                'reference_number' => 'TKT-' . strtoupper(\Illuminate\Support\Str::random(10)),
                'price' => $ticket->price,
                'status' => $this->faker->randomElement(['not_scanned', 'scanned', 'expired', 'cancelled']),
                'scanned_at' => $this->faker->optional(0.3)->dateTimeThisYear(),
                'purchased_at' => now()->subDays(rand(1, 30)),
                'payment_reference' => 'PAY-' . strtoupper(\Illuminate\Support\Str::random(10)),
            ]);
        }
    }
}
