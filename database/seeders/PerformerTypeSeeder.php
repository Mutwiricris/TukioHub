<?php

namespace Database\Seeders;

use App\Models\PerformerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerformerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $performerTypes = [
            [
                'name' => 'Musician',
                'description' => 'Solo artists, bands, and musical groups performing live music'
            ],
            [
                'name' => 'DJ',
                'description' => 'Disc jockeys and electronic music performers'
            ],
            [
                'name' => 'Comedian',
                'description' => 'Stand-up comedians and comedy performers'
            ],
            [
                'name' => 'Speaker',
                'description' => 'Keynote speakers, motivational speakers, and presenters'
            ],
            [
                'name' => 'Actor',
                'description' => 'Theater actors and dramatic performers'
            ],
            [
                'name' => 'Dancer',
                'description' => 'Professional dancers and dance groups'
            ],
            [
                'name' => 'Poet',
                'description' => 'Spoken word artists and poetry performers'
            ],
            [
                'name' => 'Artist',
                'description' => 'Visual artists, painters, and creative professionals'
            ],
            [
                'name' => 'Chef',
                'description' => 'Celebrity chefs and culinary experts'
            ],
            [
                'name' => 'Athlete',
                'description' => 'Professional athletes and sports personalities'
            ],
            [
                'name' => 'Influencer',
                'description' => 'Social media influencers and content creators'
            ],
            [
                'name' => 'Author',
                'description' => 'Writers, authors, and literary personalities'
            ]
        ];

        foreach ($performerTypes as $type) {
            PerformerType::create($type);
        }
    }
}
