<?php

namespace Database\Seeders;

use App\Models\EventSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // This seeder is now handled by EventSessionSeeder
        // Keeping this for backward compatibility
        $this->call(EventSessionSeeder::class);
    }
}
