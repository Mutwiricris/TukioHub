<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'event_type_id' => 1, // Music Festival
                'venue_id' => 9, // Laurens Garden
                'organizer_id' => 1, // Blankets & Wine Kenya
                'name' => 'Blankets & Wine: Afro-Fusion Experience',
                'title' => 'The Ultimate Afro-Fusion Music Festival',
                'description' => 'Join us for an unforgettable day of music, food, and culture at Kenya\'s premier outdoor music festival. Featuring top local and international artists performing afro-fusion, soul, and contemporary music.',
                'start_date' => now()->addDays(30)->setTime(14, 0),
                'end_date' => now()->addDays(30)->setTime(22, 0),
                'image_url' => 'https://images.unsplash.com/photo-1527261834078-9b37d35a4a32?w=800',
                'status' => 'published',
                'max_capacity' => 1500,
                'is_featured' => true,
                'slug' => 'blankets-wine-afro-fusion-experience'
            ],
            [
                'event_type_id' => 3, // Conference
                'venue_id' => 8, // iHub
                'organizer_id' => 2, // TechCrunch Kenya
                'name' => 'Africa\'s Talking AI Summit 2025',
                'title' => 'The Future of AI in Africa',
                'description' => 'Explore the latest developments in artificial intelligence and machine learning across Africa. Connect with industry leaders, startups, and innovators shaping the future of technology.',
                'start_date' => now()->addDays(45)->setTime(9, 0),
                'end_date' => now()->addDays(45)->setTime(17, 0),
                'image_url' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800',
                'status' => 'published',
                'max_capacity' => 200,
                'is_featured' => true,
                'slug' => 'africas-talking-ai-summit-2025'
            ],
            [
                'event_type_id' => 7, // Art Exhibition
                'venue_id' => 3, // Nairobi National Museum
                'organizer_id' => 3, // Nairobi Cultural Arts
                'name' => 'Contemporary African Art Showcase',
                'title' => 'Celebrating Modern African Creativity',
                'description' => 'Discover the vibrant world of contemporary African art through paintings, sculptures, and digital installations by emerging and established artists.',
                'start_date' => now()->addDays(20)->setTime(10, 0),
                'end_date' => now()->addDays(27)->setTime(18, 0),
                'image_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800',
                'status' => 'published',
                'max_capacity' => 500,
                'is_featured' => false,
                'slug' => 'contemporary-african-art-showcase'
            ],
            [
                'event_type_id' => 6, // Sports Event
                'venue_id' => 6, // Kasarani Sports Complex
                'organizer_id' => 4, // Kenya Sports Events
                'name' => 'Nairobi Marathon 2025',
                'title' => 'Run for a Cause',
                'description' => 'Join thousands of runners in Kenya\'s biggest marathon event. Multiple categories including full marathon, half marathon, and 10K fun run.',
                'start_date' => now()->addDays(60)->setTime(6, 0),
                'end_date' => now()->addDays(60)->setTime(12, 0),
                'image_url' => 'https://images.unsplash.com/photo-1459865264687-595d652de67e?w=800',
                'status' => 'published',
                'max_capacity' => 10000,
                'is_featured' => true,
                'slug' => 'nairobi-marathon-2025'
            ],
            [
                'event_type_id' => 8, // Food Festival
                'venue_id' => 2, // Carnivore Restaurant
                'organizer_id' => 5, // Taste of Kenya
                'name' => 'Taste of Kenya Food Festival',
                'title' => 'A Culinary Journey Through Kenya',
                'description' => 'Experience the rich flavors of Kenyan cuisine with dishes from all 47 counties. Meet celebrity chefs, attend cooking demonstrations, and enjoy live entertainment.',
                'start_date' => now()->addDays(25)->setTime(11, 0),
                'end_date' => now()->addDays(25)->setTime(20, 0),
                'image_url' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800',
                'status' => 'published',
                'max_capacity' => 800,
                'is_featured' => true,
                'slug' => 'taste-of-kenya-food-festival'
            ],
            [
                'event_type_id' => 5, // Comedy Show
                'venue_id' => 7, // Alliance Française
                'organizer_id' => 6, // Nairobi Comedy Club
                'name' => 'Nairobi Comedy Night',
                'title' => 'Laughter is the Best Medicine',
                'description' => 'Get ready for a night of non-stop laughter with Kenya\'s funniest comedians. Featuring Eric Omondi, Chipukeezy, and special guest performers.',
                'start_date' => now()->addDays(15)->setTime(19, 0),
                'end_date' => now()->addDays(15)->setTime(22, 0),
                'image_url' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=800',
                'status' => 'published',
                'max_capacity' => 300,
                'is_featured' => false,
                'slug' => 'nairobi-comedy-night'
            ],
            [
                'event_type_id' => 10, // Fashion Show
                'venue_id' => 1, // KICC
                'organizer_id' => 7, // East Africa Fashion Week
                'name' => 'East Africa Fashion Week 2025',
                'title' => 'Runway to the Future',
                'description' => 'The biggest fashion event in East Africa showcasing the latest trends from top designers across the region.',
                'start_date' => now()->addDays(40)->setTime(18, 0),
                'end_date' => now()->addDays(42)->setTime(22, 0),
                'image_url' => 'https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=800',
                'status' => 'published',
                'max_capacity' => 2000,
                'is_featured' => true,
                'slug' => 'east-africa-fashion-week-2025'
            ],
            [
                'event_type_id' => 2, // Concert
                'venue_id' => 3, // Uhuru Gardens
                'organizer_id' => 1, // Blankets & Wine Kenya
                'name' => 'Sauti Sol Live in Concert',
                'title' => 'The Midnight Train Tour',
                'description' => 'Kenya\'s award-winning band Sauti Sol performs their greatest hits and new songs from their latest album.',
                'start_date' => now()->addDays(35)->setTime(19, 0),
                'end_date' => now()->addDays(35)->setTime(23, 0),
                'image_url' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=800',
                'status' => 'published',
                'max_capacity' => 5000,
                'is_featured' => true,
                'slug' => 'sauti-sol-live-concert'
            ],
            [
                'event_type_id' => 9, // Tech Meetup
                'venue_id' => 8, // iHub
                'organizer_id' => 2, // TechCrunch Kenya
                'name' => 'Startup Pitch Night',
                'title' => 'Where Ideas Meet Investment',
                'description' => 'Watch promising startups pitch their ideas to investors and industry experts. Network with entrepreneurs and tech enthusiasts.',
                'start_date' => now()->addDays(10)->setTime(18, 0),
                'end_date' => now()->addDays(10)->setTime(21, 0),
                'image_url' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800',
                'status' => 'published',
                'max_capacity' => 150,
                'is_featured' => false,
                'slug' => 'startup-pitch-night'
            ],
            [
                'event_type_id' => 12, // Networking Event
                'venue_id' => 10, // Panari Hotel Convention Centre
                'organizer_id' => 9, // Kenya Business Summit
                'name' => 'Kenya Business Leaders Summit',
                'title' => 'Shaping the Future of Business',
                'description' => 'Connect with top business leaders, entrepreneurs, and industry experts. Discuss trends, challenges, and opportunities in the Kenyan market.',
                'start_date' => now()->addDays(50)->setTime(8, 0),
                'end_date' => now()->addDays(50)->setTime(17, 0),
                'image_url' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800',
                'status' => 'published',
                'max_capacity' => 500,
                'is_featured' => false,
                'slug' => 'kenya-business-leaders-summit'
            ],
            [
                'event_type_id' => 4, // Workshop
                'venue_id' => 7, // Alliance Française
                'organizer_id' => 10, // Wellness Kenya
                'name' => 'Mindfulness & Meditation Workshop',
                'title' => 'Find Your Inner Peace',
                'description' => 'Learn practical mindfulness and meditation techniques to reduce stress and improve mental well-being.',
                'start_date' => now()->addDays(18)->setTime(9, 0),
                'end_date' => now()->addDays(18)->setTime(16, 0),
                'image_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
                'status' => 'published',
                'max_capacity' => 50,
                'is_featured' => false,
                'slug' => 'mindfulness-meditation-workshop'
            ],
            [
                'event_type_id' => 1, // Music Festival
                'venue_id' => 3, // Uhuru Gardens
                'organizer_id' => 1, // Blankets & Wine Kenya
                'name' => 'Koroga Festival',
                'title' => 'Music, Food & Culture',
                'description' => 'A celebration of Kenyan music and culture featuring local artists, traditional food, and cultural performances.',
                'start_date' => now()->addDays(70)->setTime(12, 0),
                'end_date' => now()->addDays(70)->setTime(20, 0),
                'image_url' => 'https://images.unsplash.com/photo-1527261834078-9b37d35a4a32?w=800',
                'status' => 'published',
                'max_capacity' => 8000,
                'is_featured' => true,
                'slug' => 'koroga-festival'
            ]
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
