<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrganizerManager;
use App\Models\Organizer;

class OrganizerManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample organizer managers with their organizer profiles
        $managers = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@eventpro.co.ke',
                'phone' => '+254712345678',
                'organizer' => [
                    'name' => 'EventPro Kenya',
                    'description' => 'Professional event management company specializing in corporate and social events.',
                    'website' => 'https://eventpro.co.ke',
                    'email' => 'info@eventpro.co.ke',
                    'phone' => '+254712345678',
                    'is_verified' => true,
                    'is_primary' => true,
                ]
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Wanjiku',
                'email' => 'sarah@nairobi-events.com',
                'phone' => '+254723456789',
                'organizer' => [
                    'name' => 'Nairobi Events Hub',
                    'description' => 'Creating memorable experiences through innovative event planning and execution.',
                    'website' => 'https://nairobi-events.com',
                    'email' => 'hello@nairobi-events.com',
                    'phone' => '+254723456789',
                    'is_verified' => true,
                    'is_primary' => true,
                ]
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Ochieng',
                'email' => 'michael@coastalevents.co.ke',
                'phone' => '+254734567890',
                'organizer' => [
                    'name' => 'Coastal Events Mombasa',
                    'description' => 'Coastal Kenya\'s premier event organizer for beach weddings, conferences, and cultural events.',
                    'website' => 'https://coastalevents.co.ke',
                    'email' => 'info@coastalevents.co.ke',
                    'phone' => '+254734567890',
                    'is_verified' => false,
                    'is_primary' => true,
                ]
            ]
        ];

        foreach ($managers as $managerData) {
            $organizerData = $managerData['organizer'];
            unset($managerData['organizer']);

            // Create the organizer manager
            $manager = OrganizerManager::create([
                ...$managerData,
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
                'is_active' => true,
            ]);

            // Create the associated organizer profile
            $manager->organizers()->create($organizerData);
        }

        $this->command->info('Created ' . count($managers) . ' organizer managers with their organizer profiles.');
    }
}
