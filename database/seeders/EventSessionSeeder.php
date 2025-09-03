<?php

namespace Database\Seeders;

use App\Models\EventSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventSessions = [
            // Africa's Talking AI Summit 2025 (Event ID: 2) - Conference sessions
            [
                'event_id' => 2,
                'title' => 'Opening Keynote: The Future of AI in Africa',
                'description' => 'Welcome address and overview of AI developments across the African continent.',
                'start_time' => now()->addDays(45)->setTime(9, 0),
                'end_time' => now()->addDays(45)->setTime(9, 45),
                'speaker' => 'Dr. Amina Hassan - AI Research Director',
                'location' => 'Main Hall'
            ],
            [
                'event_id' => 2,
                'title' => 'Machine Learning for Healthcare in Kenya',
                'description' => 'Exploring how ML is transforming healthcare delivery in Kenya.',
                'start_time' => now()->addDays(45)->setTime(10, 0),
                'end_time' => now()->addDays(45)->setTime(10, 45),
                'speaker' => 'Dr. James Mwangi - Medical AI Specialist',
                'location' => 'Conference Room A'
            ],
            [
                'event_id' => 2,
                'title' => 'Fintech Innovation with AI',
                'description' => 'How artificial intelligence is revolutionizing financial services.',
                'start_time' => now()->addDays(45)->setTime(11, 15),
                'end_time' => now()->addDays(45)->setTime(12, 0),
                'speaker' => 'Sarah Kimani - Fintech Innovation Lead',
                'location' => 'Conference Room B'
            ],
            [
                'event_id' => 2,
                'title' => 'Panel Discussion: Ethics in AI',
                'description' => 'Discussing the ethical implications of AI development and deployment.',
                'start_time' => now()->addDays(45)->setTime(14, 0),
                'end_time' => now()->addDays(45)->setTime(15, 0),
                'speaker' => 'Panel of AI Ethics Experts',
                'location' => 'Main Hall'
            ],
            [
                'event_id' => 2,
                'title' => 'Startup Pitch: AI Solutions',
                'description' => 'African startups presenting their AI-powered solutions.',
                'start_time' => now()->addDays(45)->setTime(15, 30),
                'end_time' => now()->addDays(45)->setTime(16, 30),
                'speaker' => 'Various Startup Founders',
                'location' => 'Innovation Lab'
            ],

            // Kenya Business Leaders Summit (Event ID: 10) - Business sessions
            [
                'event_id' => 10,
                'title' => 'Digital Transformation in Kenyan Businesses',
                'description' => 'How digital technologies are reshaping business operations.',
                'start_time' => now()->addDays(50)->setTime(9, 0),
                'end_time' => now()->addDays(50)->setTime(10, 0),
                'speaker' => 'Michael Ochieng - Digital Strategy Consultant',
                'location' => 'Ballroom A'
            ],
            [
                'event_id' => 10,
                'title' => 'Sustainable Business Practices',
                'description' => 'Building environmentally conscious and profitable businesses.',
                'start_time' => now()->addDays(50)->setTime(10, 30),
                'end_time' => now()->addDays(50)->setTime(11, 30),
                'speaker' => 'Grace Wanjiku - Sustainability Expert',
                'location' => 'Conference Room 1'
            ],
            [
                'event_id' => 10,
                'title' => 'Access to Capital for SMEs',
                'description' => 'Exploring funding opportunities for small and medium enterprises.',
                'start_time' => now()->addDays(50)->setTime(12, 0),
                'end_time' => now()->addDays(50)->setTime(13, 0),
                'speaker' => 'David Mutua - Investment Banking',
                'location' => 'Conference Room 2'
            ],
            [
                'event_id' => 10,
                'title' => 'Export Market Opportunities',
                'description' => 'Identifying and accessing international markets for Kenyan products.',
                'start_time' => now()->addDays(50)->setTime(14, 0),
                'end_time' => now()->addDays(50)->setTime(15, 0),
                'speaker' => 'Catherine Wambui - Trade Expert',
                'location' => 'Ballroom B'
            ],

            // East Africa Fashion Week 2025 (Event ID: 7) - Fashion show sessions
            [
                'event_id' => 7,
                'title' => 'Opening Runway Show',
                'description' => 'Spectacular opening featuring top East African designers.',
                'start_time' => now()->addDays(40)->setTime(18, 0),
                'end_time' => now()->addDays(40)->setTime(19, 30),
                'speaker' => 'Various Designers',
                'location' => 'Main Runway'
            ],
            [
                'event_id' => 7,
                'title' => 'Sustainable Fashion Panel',
                'description' => 'Discussion on eco-friendly fashion practices in East Africa.',
                'start_time' => now()->addDays(41)->setTime(14, 0),
                'end_time' => now()->addDays(41)->setTime(15, 30),
                'speaker' => 'Sustainable Fashion Experts',
                'location' => 'Conference Hall'
            ],
            [
                'event_id' => 7,
                'title' => 'Emerging Designers Showcase',
                'description' => 'Platform for new and upcoming fashion designers.',
                'start_time' => now()->addDays(41)->setTime(16, 0),
                'end_time' => now()->addDays(41)->setTime(17, 30),
                'speaker' => 'Emerging Designers',
                'location' => 'Studio Runway'
            ],
            [
                'event_id' => 7,
                'title' => 'Grand Finale Show',
                'description' => 'Closing ceremony with award presentations and final runway show.',
                'start_time' => now()->addDays(42)->setTime(20, 0),
                'end_time' => now()->addDays(42)->setTime(22, 0),
                'speaker' => 'Award Winners & Top Designers',
                'location' => 'Main Runway'
            ],

            // Mindfulness & Meditation Workshop (Event ID: 11) - Workshop sessions
            [
                'event_id' => 11,
                'title' => 'Introduction to Mindfulness',
                'description' => 'Basic principles and benefits of mindfulness practice.',
                'start_time' => now()->addDays(18)->setTime(9, 0),
                'end_time' => now()->addDays(18)->setTime(10, 30),
                'speaker' => 'Fatuma Hassan - Mindfulness Instructor',
                'location' => 'Meditation Room'
            ],
            [
                'event_id' => 11,
                'title' => 'Breathing Techniques Workshop',
                'description' => 'Learning various breathing exercises for stress relief.',
                'start_time' => now()->addDays(18)->setTime(11, 0),
                'end_time' => now()->addDays(18)->setTime(12, 0),
                'speaker' => 'Rose Nyokabi - Wellness Coach',
                'location' => 'Meditation Room'
            ],
            [
                'event_id' => 11,
                'title' => 'Guided Meditation Session',
                'description' => 'Practical meditation session for beginners and experienced practitioners.',
                'start_time' => now()->addDays(18)->setTime(14, 0),
                'end_time' => now()->addDays(18)->setTime(15, 0),
                'speaker' => 'Lucy Wanjiru - Meditation Guide',
                'location' => 'Meditation Room'
            ],
            [
                'event_id' => 11,
                'title' => 'Mindfulness in Daily Life',
                'description' => 'Integrating mindfulness practices into everyday activities.',
                'start_time' => now()->addDays(18)->setTime(15, 30),
                'end_time' => now()->addDays(18)->setTime(16, 0),
                'speaker' => 'Daniel Kiptoo - Life Coach',
                'location' => 'Meditation Room'
            ]
        ];

        foreach ($eventSessions as $session) {
            EventSession::create($session);
        }
    }
}
