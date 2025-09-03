<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Base data seeders (no dependencies)
            UserSeeder::class,
            EventTypeSeeder::class,
            VenueSeeder::class,
            TicketTypeSeeder::class,
            PerformerTypeSeeder::class,

            // Dependent seeders (require base data)
            OrganizerSeeder::class,
            PerformerSeeder::class,
            EventSeeder::class,
            TicketSeeder::class,
            SponsorSeeder::class,
            PromoCodeSeeder::class,
            EventSessionSeeder::class,

            // Transaction seeders (require events and users)
            OrderSeeder::class,
            BookingSeeder::class,
            AttendeeSeeder::class,
            ReviewSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            WaitlistEntrySeeder::class,
            EventStatSeeder::class,
        ]);
    }
}
