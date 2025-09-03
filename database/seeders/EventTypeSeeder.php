<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventTypes = [
            [
                'name' => 'Music Festival',
                'description' => 'Large-scale music events featuring multiple artists and genres',
                'icon' => 'music',
                'color' => '#10b981'
            ],
            [
                'name' => 'Concert',
                'description' => 'Live musical performances by individual artists or bands',
                'icon' => 'mic',
                'color' => '#3b82f6'
            ],
            [
                'name' => 'Conference',
                'description' => 'Professional gatherings for knowledge sharing and networking',
                'icon' => 'users',
                'color' => '#8b5cf6'
            ],
            [
                'name' => 'Workshop',
                'description' => 'Interactive learning sessions and skill development',
                'icon' => 'tool',
                'color' => '#f59e0b'
            ],
            [
                'name' => 'Comedy Show',
                'description' => 'Stand-up comedy and entertainment performances',
                'icon' => 'smile',
                'color' => '#ef4444'
            ],
            [
                'name' => 'Sports Event',
                'description' => 'Athletic competitions and sporting activities',
                'icon' => 'trophy',
                'color' => '#06b6d4'
            ],
            [
                'name' => 'Art Exhibition',
                'description' => 'Visual arts displays and cultural showcases',
                'icon' => 'palette',
                'color' => '#ec4899'
            ],
            [
                'name' => 'Food Festival',
                'description' => 'Culinary events celebrating food and beverages',
                'icon' => 'utensils',
                'color' => '#84cc16'
            ],
            [
                'name' => 'Tech Meetup',
                'description' => 'Technology-focused gatherings and innovation showcases',
                'icon' => 'cpu',
                'color' => '#6366f1'
            ],
            [
                'name' => 'Fashion Show',
                'description' => 'Fashion presentations and style exhibitions',
                'icon' => 'shirt',
                'color' => '#d946ef'
            ],
            [
                'name' => 'Theater Performance',
                'description' => 'Dramatic performances and theatrical productions',
                'icon' => 'theater-masks',
                'color' => '#f97316'
            ],
            [
                'name' => 'Networking Event',
                'description' => 'Professional networking and business connections',
                'icon' => 'network',
                'color' => '#64748b'
            ]
        ];

        foreach ($eventTypes as $type) {
            EventType::create($type);
        }
    }
}
