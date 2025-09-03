<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsors = [
            [
                'name' => 'Safaricom PLC',
                'description' => 'Kenya\'s leading telecommunications company, connecting people and transforming lives.',
                'logo_url' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400',
                'website' => 'https://safaricom.co.ke',
                'contact_email' => 'partnerships@safaricom.co.ke',
                'contact_phone' => '+254722000000',
                'tier' => 'platinum'
            ],
            [
                'name' => 'Equity Bank',
                'description' => 'Pan-African financial services provider committed to transforming lives.',
                'logo_url' => 'https://images.unsplash.com/photo-1541354329998-f4d9a9f9297f?w=400',
                'website' => 'https://equitybank.co.ke',
                'contact_email' => 'marketing@equitybank.co.ke',
                'contact_phone' => '+254763000000',
                'tier' => 'platinum'
            ],
            [
                'name' => 'KCB Bank',
                'description' => 'Your listening bank, providing innovative financial solutions.',
                'logo_url' => 'https://images.unsplash.com/photo-1541354329998-f4d9a9f9297f?w=400',
                'website' => 'https://kcbgroup.com',
                'contact_email' => 'info@kcbgroup.com',
                'contact_phone' => '+254711087000',
                'tier' => 'gold'
            ],
            [
                'name' => 'Coca-Cola Kenya',
                'description' => 'Refreshing the world and making a difference in people\'s lives.',
                'logo_url' => 'https://images.unsplash.com/photo-1554866585-cd94860890b7?w=400',
                'website' => 'https://coca-cola.co.ke',
                'contact_email' => 'info@coca-cola.co.ke',
                'contact_phone' => '+254202699000',
                'tier' => 'gold'
            ],
            [
                'name' => 'Tusker Beer',
                'description' => 'Kenya\'s premium beer brand, celebrating life\'s moments.',
                'logo_url' => 'https://images.unsplash.com/photo-1608270586620-248524c67de9?w=400',
                'website' => 'https://tusker.co.ke',
                'contact_email' => 'marketing@eabl.com',
                'contact_phone' => '+254202862000',
                'tier' => 'gold'
            ],
            [
                'name' => 'Nation Media Group',
                'description' => 'East Africa\'s largest independent media house.',
                'logo_url' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=400',
                'website' => 'https://nationmedia.com',
                'contact_email' => 'info@nationmedia.com',
                'contact_phone' => '+254203288000',
                'tier' => 'silver'
            ],
            [
                'name' => 'Standard Chartered Bank',
                'description' => 'Here for good, driving commerce and prosperity.',
                'logo_url' => 'https://images.unsplash.com/photo-1541354329998-f4d9a9f9297f?w=400',
                'website' => 'https://sc.com/ke',
                'contact_email' => 'kenya@sc.com',
                'contact_phone' => '+254203293900',
                'tier' => 'silver'
            ],
            [
                'name' => 'Kenya Airways',
                'description' => 'The Pride of Africa, connecting Kenya to the world.',
                'logo_url' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=400',
                'website' => 'https://kenya-airways.com',
                'contact_email' => 'info@kenya-airways.com',
                'contact_phone' => '+254203274747',
                'tier' => 'silver'
            ],
            [
                'name' => 'Airtel Kenya',
                'description' => 'Smartphone network, empowering digital transformation.',
                'logo_url' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400',
                'website' => 'https://airtel.co.ke',
                'contact_email' => 'info@ke.airtel.com',
                'contact_phone' => '+254734000000',
                'tier' => 'bronze'
            ],
            [
                'name' => 'Nairobi Java House',
                'description' => 'Premium coffee experience and lifestyle brand.',
                'logo_url' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=400',
                'website' => 'https://javahouseafrica.com',
                'contact_email' => 'info@javahouseafrica.com',
                'contact_phone' => '+254202699300',
                'tier' => 'bronze'
            ],
            [
                'name' => 'Uber Kenya',
                'description' => 'Move the way you want, technology that moves you.',
                'logo_url' => 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=400',
                'website' => 'https://uber.com/ke',
                'contact_email' => 'kenya@uber.com',
                'contact_phone' => '+254700000000',
                'tier' => 'bronze'
            ],
            [
                'name' => 'Jumia Kenya',
                'description' => 'Leading e-commerce platform in Africa.',
                'logo_url' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=400',
                'website' => 'https://jumia.co.ke',
                'contact_email' => 'partnerships@jumia.co.ke',
                'contact_phone' => '+254709999000',
                'tier' => 'bronze'
            ]
        ];

        foreach ($sponsors as $sponsor) {
            Sponsor::create($sponsor);
        }
    }
}
