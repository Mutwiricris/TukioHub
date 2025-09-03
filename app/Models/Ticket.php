<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'event_id',
        'ticket_type_id',
        'price',
        'quantity',
        'available_from',
        'available_until',
        'currency'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'available_from' => 'datetime',
        'available_until' => 'datetime'
    ];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function waitlistEntries()
    {
        return $this->hasMany(WaitlistEntry::class);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('quantity', '>', 0)
                    ->where(function($q) {
                        $q->whereNull('available_from')
                          ->orWhere('available_from', '<=', now());
                    })
                    ->where(function($q) {
                        $q->whereNull('available_until')
                          ->orWhere('available_until', '>=', now());
                    });
    }

    public function scopeInStock($query)
    {
        return $query->where('quantity', '>', 0);
    }

    // Methods
    public function isAvailable()
    {
        return $this->quantity > 0
            && (is_null($this->available_from) || $this->available_from <= now())
            && (is_null($this->available_until) || $this->available_until >= now());
    }

    public function isSoldOut()
    {
        return $this->quantity <= 0;
    }

    public function getRemainingQuantityAttribute()
    {
        $sold = $this->orderItems()->sum('quantity');
        return $this->quantity - $sold;
    }
}
