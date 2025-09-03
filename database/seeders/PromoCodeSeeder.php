<?php

namespace Database\Seeders;

use App\Models\PromoCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promoCodes = [
            [
                'code' => 'EARLYBIRD2025',
                'description' => 'Early bird discount for 2025 events',
                'discount_type' => 'percentage',
                'discount_value' => 20.00,
                'max_uses' => 100,
                'used_count' => 0,
                'valid_from' => now(),
                'valid_until' => now()->addDays(30),
                'is_active' => true
            ],
            [
                'code' => 'STUDENT50',
                'description' => 'Student discount - 50% off',
                'discount_type' => 'percentage',
                'discount_value' => 50.00,
                'max_uses' => 200,
                'used_count' => 0,
                'valid_from' => now(),
                'valid_until' => now()->addDays(90),
                'is_active' => true
            ],
            [
                'code' => 'WELCOME1000',
                'description' => 'Welcome bonus - KES 1000 off',
                'discount_type' => 'fixed',
                'discount_value' => 1000.00,
                'max_uses' => 50,
                'used_count' => 0,
                'valid_from' => now(),
                'valid_until' => now()->addDays(60),
                'is_active' => true
            ],
            [
                'code' => 'GROUPDEAL',
                'description' => 'Group booking discount - 15% off',
                'discount_type' => 'percentage',
                'discount_value' => 15.00,
                'max_uses' => null,
                'used_count' => 0,
                'valid_from' => now(),
                'valid_until' => now()->addDays(120),
                'is_active' => true
            ],
            [
                'code' => 'WEEKEND25',
                'description' => 'Weekend events special - 25% off',
                'discount_type' => 'percentage',
                'discount_value' => 25.00,
                'max_uses' => 75,
                'used_count' => 0,
                'valid_from' => now(),
                'valid_until' => now()->addDays(45),
                'is_active' => true
            ],
            [
                'code' => 'LOYALTY500',
                'description' => 'Loyalty customer discount - KES 500 off',
                'discount_type' => 'fixed',
                'discount_value' => 500.00,
                'max_uses' => 150,
                'used_count' => 0,
                'valid_from' => now(),
                'valid_until' => now()->addDays(180),
                'is_active' => true
            ],
            [
                'code' => 'FLASH30',
                'description' => 'Flash sale - 30% off for 24 hours',
                'discount_type' => 'percentage',
                'discount_value' => 30.00,
                'max_uses' => 25,
                'used_count' => 0,
                'valid_from' => now(),
                'valid_until' => now()->addHours(24),
                'is_active' => true
            ],
            [
                'code' => 'CORPORATE10',
                'description' => 'Corporate booking discount - 10% off',
                'discount_type' => 'percentage',
                'discount_value' => 10.00,
                'max_uses' => null,
                'used_count' => 0,
                'valid_from' => now(),
                'valid_until' => now()->addDays(365),
                'is_active' => true
            ],
            [
                'code' => 'FAMILY2000',
                'description' => 'Family package discount - KES 2000 off',
                'discount_type' => 'fixed',
                'discount_value' => 2000.00,
                'max_uses' => 40,
                'used_count' => 0,
                'valid_from' => now(),
                'valid_until' => now()->addDays(90),
                'is_active' => true
            ],
            [
                'code' => 'EXPIRED10',
                'description' => 'Expired promo code for testing',
                'discount_type' => 'percentage',
                'discount_value' => 10.00,
                'max_uses' => 100,
                'used_count' => 0,
                'valid_from' => now()->subDays(30),
                'valid_until' => now()->subDays(1),
                'is_active' => false
            ]
        ];

        foreach ($promoCodes as $promoCode) {
            PromoCode::create($promoCode);
        }
    }
}
