<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'user_id' => 1,
                'event_id' => 1,
                'rating' => 5,
                'comment' => 'Amazing event! The organization was perfect and the performers were incredible. Would definitely attend again.',
                'created_at' => now()->subDays(5),
            ],
            [
                'user_id' => 2,
                'event_id' => 1,
                'rating' => 4,
                'comment' => 'Great experience overall. The venue was nice and the sound quality was excellent. Only minor issue was the long queue for drinks.',
                'created_at' => now()->subDays(3),
            ],
            [
                'user_id' => 3,
                'event_id' => 1,
                'rating' => 5,
                'comment' => 'Exceeded all expectations! The lineup was fantastic and the atmosphere was electric. Best event I\'ve been to this year.',
                'created_at' => now()->subDays(2),
            ],
            [
                'user_id' => 4,
                'event_id' => 2,
                'rating' => 4,
                'comment' => 'Solid event with good production value. The performers were engaging and the venue was comfortable.',
                'created_at' => now()->subDays(4),
            ],
            [
                'user_id' => 5,
                'event_id' => 2,
                'rating' => 3,
                'comment' => 'It was okay. Some technical issues with the sound system but the performers handled it well.',
                'created_at' => now()->subDays(1),
            ],
            [
                'user_id' => 1,
                'event_id' => 3,
                'rating' => 5,
                'comment' => 'Absolutely phenomenal! Every detail was perfect from start to finish. The organizers really know how to put on a show.',
                'created_at' => now()->subDays(6),
            ],
        ];

        foreach ($reviews as $review) {
            \App\Models\Review::create($review);
        }
    }
}
