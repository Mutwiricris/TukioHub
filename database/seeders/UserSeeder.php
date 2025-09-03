<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Kamau',
                'email' => 'john.kamau@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Mary Wanjiku',
                'email' => 'mary.wanjiku@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Peter Ochieng',
                'email' => 'peter.ochieng@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Grace Akinyi',
                'email' => 'grace.akinyi@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Samuel Kiprop',
                'email' => 'samuel.kiprop@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Faith Njeri',
                'email' => 'faith.njeri@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'David Mwangi',
                'email' => 'david.mwangi@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Catherine Wambui',
                'email' => 'catherine.wambui@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'James Kiprotich',
                'email' => 'james.kiprotich@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Rose Nyokabi',
                'email' => 'rose.nyokabi@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Michael Otieno',
                'email' => 'michael.otieno@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Lucy Wanjiru',
                'email' => 'lucy.wanjiru@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Daniel Kiptoo',
                'email' => 'daniel.kiptoo@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Esther Muthoni',
                'email' => 'esther.muthoni@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Francis Mutua',
                'email' => 'francis.mutua@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@tukiohub.co.ke',
                'password' => bcrypt('admin123'),
                'email_verified_at' => now(),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
