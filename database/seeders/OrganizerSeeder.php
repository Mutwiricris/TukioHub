<?php

namespace Database\Seeders;

use App\Models\Organizer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First create some organizer users
        $organizerUsers = [
            [
                'name' => 'Sarah Kimani',
                'email' => 'sarah@blanketsandwine.co.ke',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'David Mutua',
                'email' => 'david@techevents.ke',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Grace Wanjiku',
                'email' => 'grace@culturalarts.ke',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Michael Ochieng',
                'email' => 'michael@sportsevents.ke',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Fatuma Hassan',
                'email' => 'fatuma@foodfestivals.ke',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        ];

        foreach ($organizerUsers as $userData) {
            User::create($userData);
        }

        $organizers = [
            [
                'user_id' => 1,
                'name' => 'Blankets & Wine Kenya',
                'description' => 'Premier music festival organizer bringing together the best of Afro-fusion, soul, and contemporary music in beautiful outdoor settings.',
                'website' => 'https://blanketsandwine.co.ke',
                'email' => 'info@blanketsandwine.co.ke',
                'phone' => '+254722123456',
                'logo_url' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400',
                'is_verified' => true
            ],
            [
                'user_id' => 2,
                'name' => 'TechCrunch Kenya',
                'description' => 'Leading technology event organizer focusing on innovation, startups, and digital transformation across East Africa.',
                'website' => 'https://techcrunch.ke',
                'email' => 'events@techcrunch.ke',
                'phone' => '+254733234567',
                'logo_url' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=400',
                'is_verified' => true
            ],
            [
                'user_id' => 3,
                'name' => 'Nairobi Cultural Arts',
                'description' => 'Promoting Kenyan culture through art exhibitions, theater performances, and cultural festivals.',
                'website' => 'https://nairobiarts.ke',
                'email' => 'info@nairobiarts.ke',
                'phone' => '+254744345678',
                'logo_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
                'is_verified' => true
            ],
            [
                'user_id' => 4,
                'name' => 'Kenya Sports Events',
                'description' => 'Organizing world-class sporting events and competitions across Kenya, from marathons to football tournaments.',
                'website' => 'https://kenyasports.ke',
                'email' => 'info@kenyasports.ke',
                'phone' => '+254755456789',
                'logo_url' => 'https://images.unsplash.com/photo-1459865264687-595d652de67e?w=400',
                'is_verified' => true
            ],
            [
                'user_id' => 5,
                'name' => 'Taste of Kenya',
                'description' => 'Celebrating Kenyan cuisine and culinary traditions through food festivals and gastronomic experiences.',
                'website' => 'https://tasteofkenya.co.ke',
                'email' => 'hello@tasteofkenya.co.ke',
                'phone' => '+254766567890',
                'logo_url' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=400',
                'is_verified' => true
            ],
            [
                'user_id' => 6,
                'name' => 'Nairobi Comedy Club',
                'description' => 'Bringing laughter to Nairobi through stand-up comedy shows and entertainment events.',
                'website' => 'https://nairobicomedy.ke',
                'email' => 'bookings@nairobicomedy.ke',
                'phone' => '+254777678901',
                'logo_url' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=400',
                'is_verified' => false
            ],
            [
                'user_id' => 7,
                'name' => 'East Africa Fashion Week',
                'description' => 'Showcasing the best of East African fashion through runway shows and designer exhibitions.',
                'website' => 'https://eafashionweek.com',
                'email' => 'info@eafashionweek.com',
                'phone' => '+254788789012',
                'logo_url' => 'https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=400',
                'is_verified' => true
            ],
            [
                'user_id' => 8,
                'name' => 'Nairobi International Film Festival',
                'description' => 'Celebrating cinema and storytelling through film screenings, workshops, and industry networking.',
                'website' => 'https://nairobifilmfest.ke',
                'email' => 'submissions@nairobifilmfest.ke',
                'phone' => '+254799890123',
                'logo_url' => 'https://images.unsplash.com/photo-1489599904472-84978f312f2e?w=400',
                'is_verified' => true
            ],
            [
                'user_id' => 9,
                'name' => 'Kenya Business Summit',
                'description' => 'Connecting business leaders and entrepreneurs through conferences and networking events.',
                'website' => 'https://kenyabusinesssummit.com',
                'email' => 'info@kenyabusinesssummit.com',
                'phone' => '+254700901234',
                'logo_url' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=400',
                'is_verified' => true
            ],
            [
                'user_id' => 10,
                'name' => 'Wellness Kenya',
                'description' => 'Promoting health and wellness through yoga retreats, fitness events, and mindfulness workshops.',
                'website' => 'https://wellnesskenya.co.ke',
                'email' => 'hello@wellnesskenya.co.ke',
                'phone' => '+254711012345',
                'logo_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400',
                'is_verified' => false
            ],
            [
                'user_id' => 11,
                'name' => 'Nairobi Book Festival',
                'description' => 'Celebrating literature and reading culture through book fairs, author readings, and literary discussions.',
                'website' => 'https://nairobibookfest.ke',
                'email' => 'info@nairobibookfest.ke',
                'phone' => '+254722123456',
                'logo_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
                'is_verified' => true
            ],
            [
                'user_id' => 12,
                'name' => 'Kenya Gaming Convention',
                'description' => 'Bringing together gamers, developers, and esports enthusiasts for the ultimate gaming experience.',
                'website' => 'https://kenyagaming.co.ke',
                'email' => 'info@kenyagaming.co.ke',
                'phone' => '+254733234567',
                'logo_url' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=400',
                'is_verified' => false
            ]
        ];

        foreach ($organizers as $organizer) {
            Organizer::create($organizer);
        }
    }
}
