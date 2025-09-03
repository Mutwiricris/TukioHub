<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = [
            // Blankets & Wine: Afro-Fusion Experience (Event ID: 1)
            [
                'event_id' => 1,
                'ticket_type_id' => 4, // Early Bird
                'price' => 2500.00,
                'quantity' => 200,
                'available_from' => now(),
                'available_until' => now()->addDays(20),
                'currency' => 'KES'
            ],
            [
                'event_id' => 1,
                'ticket_type_id' => 1, // General Admission
                'price' => 3500.00,
                'quantity' => 800,
                'available_from' => now()->addDays(20),
                'available_until' => now()->addDays(29),
                'currency' => 'KES'
            ],
            [
                'event_id' => 1,
                'ticket_type_id' => 2, // VIP
                'price' => 7500.00,
                'quantity' => 150,
                'available_from' => now(),
                'available_until' => now()->addDays(29),
                'currency' => 'KES'
            ],

            // Africa's Talking AI Summit 2025 (Event ID: 2)
            [
                'event_id' => 2,
                'ticket_type_id' => 4, // Early Bird
                'price' => 5000.00,
                'quantity' => 50,
                'available_from' => now(),
                'available_until' => now()->addDays(30),
                'currency' => 'KES'
            ],
            [
                'event_id' => 2,
                'ticket_type_id' => 1, // General Admission
                'price' => 8000.00,
                'quantity' => 120,
                'available_from' => now()->addDays(30),
                'available_until' => now()->addDays(44),
                'currency' => 'KES'
            ],
            [
                'event_id' => 2,
                'ticket_type_id' => 5, // Student
                'price' => 3000.00,
                'quantity' => 30,
                'available_from' => now(),
                'available_until' => now()->addDays(44),
                'currency' => 'KES'
            ],

            // Contemporary African Art Showcase (Event ID: 3)
            [
                'event_id' => 3,
                'ticket_type_id' => 1, // General Admission
                'price' => 1000.00,
                'quantity' => 400,
                'available_from' => now(),
                'available_until' => now()->addDays(26),
                'currency' => 'KES'
            ],
            [
                'event_id' => 3,
                'ticket_type_id' => 5, // Student
                'price' => 500.00,
                'quantity' => 100,
                'available_from' => now(),
                'available_until' => now()->addDays(26),
                'currency' => 'KES'
            ],

            // Nairobi Marathon 2025 (Event ID: 4)
            [
                'event_id' => 4,
                'ticket_type_id' => 4, // Early Bird
                'price' => 2000.00,
                'quantity' => 1000,
                'available_from' => now(),
                'available_until' => now()->addDays(40),
                'currency' => 'KES'
            ],
            [
                'event_id' => 4,
                'ticket_type_id' => 1, // General Admission
                'price' => 3000.00,
                'quantity' => 8000,
                'available_from' => now()->addDays(40),
                'available_until' => now()->addDays(59),
                'currency' => 'KES'
            ],
            [
                'event_id' => 4,
                'ticket_type_id' => 11, // Family Pack
                'price' => 10000.00,
                'quantity' => 500,
                'available_from' => now(),
                'available_until' => now()->addDays(59),
                'currency' => 'KES'
            ],

            // Taste of Kenya Food Festival (Event ID: 5)
            [
                'event_id' => 5,
                'ticket_type_id' => 1, // General Admission
                'price' => 2000.00,
                'quantity' => 600,
                'available_from' => now(),
                'available_until' => now()->addDays(24),
                'currency' => 'KES'
            ],
            [
                'event_id' => 5,
                'ticket_type_id' => 2, // VIP
                'price' => 5000.00,
                'quantity' => 200,
                'available_from' => now(),
                'available_until' => now()->addDays(24),
                'currency' => 'KES'
            ],

            // Nairobi Comedy Night (Event ID: 6)
            [
                'event_id' => 6,
                'ticket_type_id' => 1, // General Admission
                'price' => 1500.00,
                'quantity' => 250,
                'available_from' => now(),
                'available_until' => now()->addDays(14),
                'currency' => 'KES'
            ],
            [
                'event_id' => 6,
                'ticket_type_id' => 2, // VIP
                'price' => 3000.00,
                'quantity' => 50,
                'available_from' => now(),
                'available_until' => now()->addDays(14),
                'currency' => 'KES'
            ],

            // East Africa Fashion Week 2025 (Event ID: 7)
            [
                'event_id' => 7,
                'ticket_type_id' => 8, // Day Pass
                'price' => 3000.00,
                'quantity' => 500,
                'available_from' => now(),
                'available_until' => now()->addDays(39),
                'currency' => 'KES'
            ],
            [
                'event_id' => 7,
                'ticket_type_id' => 9, // Weekend Pass
                'price' => 8000.00,
                'quantity' => 300,
                'available_from' => now(),
                'available_until' => now()->addDays(39),
                'currency' => 'KES'
            ],
            [
                'event_id' => 7,
                'ticket_type_id' => 2, // VIP
                'price' => 15000.00,
                'quantity' => 100,
                'available_from' => now(),
                'available_until' => now()->addDays(39),
                'currency' => 'KES'
            ],

            // Sauti Sol Live in Concert (Event ID: 8)
            [
                'event_id' => 8,
                'ticket_type_id' => 4, // Early Bird
                'price' => 3000.00,
                'quantity' => 500,
                'available_from' => now(),
                'available_until' => now()->addDays(25),
                'currency' => 'KES'
            ],
            [
                'event_id' => 8,
                'ticket_type_id' => 1, // General Admission
                'price' => 4500.00,
                'quantity' => 3500,
                'available_from' => now()->addDays(25),
                'available_until' => now()->addDays(34),
                'currency' => 'KES'
            ],
            [
                'event_id' => 8,
                'ticket_type_id' => 2, // VIP
                'price' => 10000.00,
                'quantity' => 200,
                'available_from' => now(),
                'available_until' => now()->addDays(34),
                'currency' => 'KES'
            ],
            [
                'event_id' => 8,
                'ticket_type_id' => 3, // VVIP
                'price' => 20000.00,
                'quantity' => 50,
                'available_from' => now(),
                'available_until' => now()->addDays(34),
                'currency' => 'KES'
            ],

            // Startup Pitch Night (Event ID: 9)
            [
                'event_id' => 9,
                'ticket_type_id' => 1, // General Admission
                'price' => 1000.00,
                'quantity' => 120,
                'available_from' => now(),
                'available_until' => now()->addDays(9),
                'currency' => 'KES'
            ],
            [
                'event_id' => 9,
                'ticket_type_id' => 5, // Student
                'price' => 500.00,
                'quantity' => 30,
                'available_from' => now(),
                'available_until' => now()->addDays(9),
                'currency' => 'KES'
            ],

            // Kenya Business Leaders Summit (Event ID: 10)
            [
                'event_id' => 10,
                'ticket_type_id' => 1, // General Admission
                'price' => 15000.00,
                'quantity' => 300,
                'available_from' => now(),
                'available_until' => now()->addDays(49),
                'currency' => 'KES'
            ],
            [
                'event_id' => 10,
                'ticket_type_id' => 7, // Corporate
                'price' => 50000.00,
                'quantity' => 50,
                'available_from' => now(),
                'available_until' => now()->addDays(49),
                'currency' => 'KES'
            ],

            // Mindfulness & Meditation Workshop (Event ID: 11)
            [
                'event_id' => 11,
                'ticket_type_id' => 1, // General Admission
                'price' => 3000.00,
                'quantity' => 50,
                'available_from' => now(),
                'available_until' => now()->addDays(17),
                'currency' => 'KES'
            ],

            // Koroga Festival (Event ID: 12)
            [
                'event_id' => 12,
                'ticket_type_id' => 4, // Early Bird
                'price' => 2000.00,
                'quantity' => 1000,
                'available_from' => now(),
                'available_until' => now()->addDays(50),
                'currency' => 'KES'
            ],
            [
                'event_id' => 12,
                'ticket_type_id' => 1, // General Admission
                'price' => 3000.00,
                'quantity' => 6000,
                'available_from' => now()->addDays(50),
                'available_until' => now()->addDays(69),
                'currency' => 'KES'
            ],
            [
                'event_id' => 12,
                'ticket_type_id' => 2, // VIP
                'price' => 8000.00,
                'quantity' => 500,
                'available_from' => now(),
                'available_until' => now()->addDays(69),
                'currency' => 'KES'
            ],
            [
                'event_id' => 12,
                'ticket_type_id' => 11, // Family Pack
                'price' => 10000.00,
                'quantity' => 500,
                'available_from' => now(),
                'available_until' => now()->addDays(69),
                'currency' => 'KES'
            ]
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}
