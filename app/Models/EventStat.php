<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'date',
        'page_views',
        'tickets_sold',
        'sales_volume'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Methods
    public static function recordPageView($eventId)
    {
        $today = now()->toDateString();

        static::updateOrCreate(
            ['event_id' => $eventId, 'date' => $today],
            ['page_views' => \DB::raw('page_views + 1')]
        );
    }

    public static function recordTicketSale($eventId, $quantity, $amount)
    {
        $today = now()->toDateString();

        static::updateOrCreate(
            ['event_id' => $eventId, 'date' => $today],
            [
                'tickets_sold' => \DB::raw("tickets_sold + {$quantity}"),
                'sales_volume' => \DB::raw("sales_volume + {$amount}")
            ]
        );
    }
}
