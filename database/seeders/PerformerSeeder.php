<?php

namespace Database\Seeders;

use App\Models\Performer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerformerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $performers = [
            [
                'performer_type_id' => 1, // Musician
                'name' => 'Sauti Sol',
                'bio' => 'Award-winning Kenyan afro-pop band known for their unique blend of traditional African music with modern pop.',
                'image_url' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400',
                'website' => 'https://sautisol.com',
                'social_media' => [
                    'instagram' => '@sautisol',
                    'twitter' => '@sautisol',
                    'facebook' => 'SautiSol'
                ],
                'is_featured' => true
            ],
            [
                'performer_type_id' => 1, // Musician
                'name' => 'Nyashinski',
                'bio' => 'Kenyan rapper and songwriter, former member of Kleptomaniax, known for his lyrical prowess.',
                'image_url' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=400',
                'website' => null,
                'social_media' => [
                    'instagram' => '@realshinski',
                    'twitter' => '@realshinski'
                ],
                'is_featured' => true
            ],
            [
                'performer_type_id' => 2, // DJ
                'name' => 'DJ Creme de la Creme',
                'bio' => 'One of Kenya\'s most celebrated DJs, known for his versatile mixing skills and crowd control.',
                'image_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400',
                'website' => null,
                'social_media' => [
                    'instagram' => '@djcreme',
                    'twitter' => '@djcreme'
                ],
                'is_featured' => true
            ],
            [
                'performer_type_id' => 3, // Comedian
                'name' => 'Eric Omondi',
                'bio' => 'Kenya\'s premier comedian and entertainer, known for his hilarious skits and stand-up performances.',
                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
                'website' => null,
                'social_media' => [
                    'instagram' => '@ericomondi',
                    'twitter' => '@ericomondi'
                ],
                'is_featured' => true
            ],
            [
                'performer_type_id' => 4, // Speaker
                'name' => 'Dr. James Mwangi',
                'bio' => 'CEO of Equity Bank and renowned business leader, inspiring entrepreneur and financial expert.',
                'image_url' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400',
                'website' => null,
                'social_media' => [
                    'linkedin' => 'james-mwangi'
                ],
                'is_featured' => false
            ],
            [
                'performer_type_id' => 1, // Musician
                'name' => 'Akothee',
                'bio' => 'Self-proclaimed President of Single Mothers, Akothee is a vibrant performer and businesswoman.',
                'image_url' => 'https://images.unsplash.com/photo-1494790108755-2616c9c0b8d3?w=400',
                'website' => null,
                'social_media' => [
                    'instagram' => '@akotheekenya',
                    'twitter' => '@akotheekenya'
                ],
                'is_featured' => true
            ],
            [
                'performer_type_id' => 6, // Dancer
                'name' => 'Quickstyle Dance Crew',
                'bio' => 'Award-winning dance crew known for their energetic performances and choreography.',
                'image_url' => 'https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=400',
                'website' => null,
                'social_media' => [
                    'instagram' => '@quickstylecrew',
                    'tiktok' => '@quickstyle'
                ],
                'is_featured' => false
            ],
            [
                'performer_type_id' => 7, // Poet
                'name' => 'Teardrops',
                'bio' => 'Renowned spoken word artist and poet, known for powerful performances on social issues.',
                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
                'website' => null,
                'social_media' => [
                    'instagram' => '@teardrops_poet'
                ],
                'is_featured' => false
            ],
            [
                'performer_type_id' => 1, // Musician
                'name' => 'Bien Baraza',
                'bio' => 'Lead vocalist of Sauti Sol, also pursuing a successful solo career with R&B influences.',
                'image_url' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400',
                'website' => null,
                'social_media' => [
                    'instagram' => '@bienaimesol',
                    'twitter' => '@bienaimesol'
                ],
                'is_featured' => true
            ],
            [
                'performer_type_id' => 2, // DJ
                'name' => 'DJ Pierra Makena',
                'bio' => 'Leading female DJ in Kenya, known for her versatile music selection and energetic performances.',
                'image_url' => 'https://images.unsplash.com/photo-1494790108755-2616c9c0b8d3?w=400',
                'website' => null,
                'social_media' => [
                    'instagram' => '@djpierramakena'
                ],
                'is_featured' => true
            ],
            [
                'performer_type_id' => 4, // Speaker
                'name' => 'Caroline Mutoko',
                'bio' => 'Media personality, entrepreneur, and motivational speaker inspiring women across Africa.',
                'image_url' => 'https://images.unsplash.com/photo-1494790108755-2616c9c0b8d3?w=400',
                'website' => null,
                'social_media' => [
                    'instagram' => '@carolinemutoko',
                    'twitter' => '@carolinemutoko'
                ],
                'is_featured' => false
            ],
            [
                'performer_type_id' => 3, // Comedian
                'name' => 'Chipukeezy',
                'bio' => 'Popular comedian and TV host known for his witty humor and entertainment shows.',
                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
                'website' => null,
                'social_media' => [
                    'instagram' => '@chipukeezy',
                    'twitter' => '@chipukeezy'
                ],
                'is_featured' => false
            ]
        ];

        foreach ($performers as $performer) {
            Performer::create($performer);
        }
    }
}
