<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $venues = [
            [
                'name' => 'Kenyatta International Convention Centre (KICC)',
                'address' => 'Harambee Avenue',
                'city' => 'Nairobi',
                'state' => 'Nairobi County',
                'country' => 'Kenya',
                'postal_code' => '00100',
                'latitude' => -1.2921,
                'longitude' => 36.8219,
                'capacity' => 4000,
                'description' => 'Premier convention center in the heart of Nairobi, perfect for large conferences and exhibitions.',
                'image_url' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800'
            ],
            [
                'name' => 'Carnivore Restaurant',
                'address' => 'Langata Road',
                'city' => 'Nairobi',
                'state' => 'Nairobi County',
                'country' => 'Kenya',
                'postal_code' => '00100',
                'latitude' => -1.3515,
                'longitude' => 36.7835,
                'capacity' => 800,
                'description' => 'Famous restaurant venue known for hosting vibrant events and cultural celebrations.',
                'image_url' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800'
            ],
            [
                'name' => 'Uhuru Gardens',
                'address' => 'Langata Road',
                'city' => 'Nairobi',
                'state' => 'Nairobi County',
                'country' => 'Kenya',
                'postal_code' => '00100',
                'latitude' => -1.3032,
                'longitude' => 36.7879,
                'capacity' => 15000,
                'description' => 'Historic outdoor venue perfect for large festivals and national celebrations.',
                'image_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800'
            ],
            [
                'name' => 'Sarit Centre Expo Hall',
                'address' => 'Westlands',
                'city' => 'Nairobi',
                'state' => 'Nairobi County',
                'country' => 'Kenya',
                'postal_code' => '00100',
                'latitude' => -1.2634,
                'longitude' => 36.8047,
                'capacity' => 2500,
                'description' => 'Modern exhibition hall in Westlands, ideal for trade shows and corporate events.',
                'image_url' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800'
            ],
            [
                'name' => 'Nairobi National Museum',
                'address' => 'Museum Hill',
                'city' => 'Nairobi',
                'state' => 'Nairobi County',
                'country' => 'Kenya',
                'postal_code' => '00100',
                'latitude' => -1.2741,
                'longitude' => 36.8155,
                'capacity' => 500,
                'description' => 'Cultural venue perfect for art exhibitions and educational events.',
                'image_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800'
            ],
            [
                'name' => 'Kasarani Sports Complex',
                'address' => 'Thika Road',
                'city' => 'Nairobi',
                'state' => 'Nairobi County',
                'country' => 'Kenya',
                'postal_code' => '00100',
                'latitude' => -1.2167,
                'longitude' => 36.8906,
                'capacity' => 60000,
                'description' => 'Massive sports complex suitable for major concerts and sporting events.',
                'image_url' => 'https://images.unsplash.com/photo-1459865264687-595d652de67e?w=800'
            ],
            [
                'name' => 'Alliance Française',
                'address' => 'Loita Street',
                'city' => 'Nairobi',
                'state' => 'Nairobi County',
                'country' => 'Kenya',
                'postal_code' => '00100',
                'latitude' => -1.2864,
                'longitude' => 36.8172,
                'capacity' => 300,
                'description' => 'Cultural center hosting intimate performances and art events.',
                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800'
            ],
            [
                'name' => 'iHub',
                'address' => 'Senteu Plaza, Galana Road',
                'city' => 'Nairobi',
                'state' => 'Nairobi County',
                'country' => 'Kenya',
                'postal_code' => '00100',
                'latitude' => -1.2921,
                'longitude' => 36.7809,
                'capacity' => 200,
                'description' => 'Tech innovation hub perfect for startup events and tech meetups.',
                'image_url' => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=800'
            ],
            [
                'name' => 'Laurens Garden',
                'address' => 'Karen',
                'city' => 'Nairobi',
                'state' => 'Nairobi County',
                'country' => 'Kenya',
                'postal_code' => '00100',
                'latitude' => -1.3197,
                'longitude' => 36.7076,
                'capacity' => 1500,
                'description' => 'Beautiful garden venue popular for music festivals and outdoor events.',
                'image_url' => 'https://images.unsplash.com/photo-1519827659669-3c3b7c3b3c3b?w=800'
            ],
            [
                'name' => 'Panari Hotel Convention Centre',
                'address' => 'Mombasa Road',
                'city' => 'Nairobi',
                'state' => 'Nairobi County',
                'country' => 'Kenya',
                'postal_code' => '00100',
                'latitude' => -1.3110,
                'longitude' => 36.8625,
                'capacity' => 1200,
                'description' => 'Luxury hotel convention center for upscale corporate and social events.',
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800'
            ],
            [
                'name' => 'Mombasa Sports Club',
                'address' => 'Mombasa Road',
                'city' => 'Mombasa',
                'state' => 'Mombasa County',
                'country' => 'Kenya',
                'postal_code' => '80100',
                'latitude' => -4.0435,
                'longitude' => 39.6682,
                'capacity' => 800,
                'description' => 'Historic sports club venue perfect for social events and gatherings.',
                'image_url' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=800'
            ],
            [
                'name' => 'Eldoret Sports Club',
                'address' => 'Uganda Road',
                'city' => 'Eldoret',
                'state' => 'Uasin Gishu County',
                'country' => 'Kenya',
                'postal_code' => '30100',
                'latitude' => 0.5143,
                'longitude' => 35.2697,
                'capacity' => 600,
                'description' => 'Community sports club hosting local events and celebrations.',
                'image_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800'
            ]
        ];

        foreach ($venues as $venue) {
            Venue::create($venue);
        }
    }
}
