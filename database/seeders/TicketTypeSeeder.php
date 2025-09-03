<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ticketTypes = [
            [
                'name' => 'General Admission',
                'description' => 'Standard entry ticket with access to all general areas and activities.'
            ],
            [
                'name' => 'VIP',
                'description' => 'Premium ticket with exclusive access to VIP areas, complimentary drinks, and priority seating.'
            ],
            [
                'name' => 'VVIP',
                'description' => 'Ultra-premium experience with backstage access, meet & greet opportunities, and luxury amenities.'
            ],
            [
                'name' => 'Early Bird',
                'description' => 'Discounted tickets available for a limited time before the event.'
            ],
            [
                'name' => 'Student',
                'description' => 'Special discounted rates for students with valid student ID.'
            ],
            [
                'name' => 'Group',
                'description' => 'Bulk tickets for groups of 5 or more people with special pricing.'
            ],
            [
                'name' => 'Corporate',
                'description' => 'Business packages including networking opportunities and corporate branding.'
            ],
            [
                'name' => 'Day Pass',
                'description' => 'Single day access for multi-day events.'
            ],
            [
                'name' => 'Weekend Pass',
                'description' => 'Full weekend access for multi-day events.'
            ],
            [
                'name' => 'Season Pass',
                'description' => 'Access to multiple events in a series or season.'
            ],
            [
                'name' => 'Family Pack',
                'description' => 'Special pricing for families with children, includes 2 adults and 2 children.'
            ],
            [
                'name' => 'Senior Citizen',
                'description' => 'Discounted tickets for senior citizens aged 60 and above.'
            ],
            [
                'name' => 'Press',
                'description' => 'Complimentary access for accredited media and press personnel.'
            ],
            [
                'name' => 'Sponsor',
                'description' => 'Complimentary tickets for event sponsors and partners.'
            ],
            [
                'name' => 'Exhibitor',
                'description' => 'Access passes for exhibitors and vendors at trade shows and exhibitions.'
            ]
        ];

        foreach ($ticketTypes as $type) {
            TicketType::create($type);
        }
    }
}
