<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id', 
        'ticket_id',
        'order_id',
        'reference_number',
        'price',
        'status',
        'scanned_at',
        'purchased_at',
        'payment_reference'
    ];

    protected $casts = [
        'scanned_at' => 'datetime',
        'purchased_at' => 'datetime',
        'price' => 'decimal:2'
    ];

    protected $attributes = [
        'status' => 'not_scanned'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function paymentTransaction(): BelongsTo
    {
        return $this->belongsTo(PaymentTransaction::class, 'payment_reference', 'reference_number');
    }

    // Scopes
    public function scopeNotScanned($query)
    {
        return $query->where('status', 'not_scanned');
    }

    public function scopeScanned($query)
    {
        return $query->where('status', 'scanned');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    public function scopeUpcoming($query)
    {
        return $query->whereHas('event', function($q) {
            $q->where('start_date', '>', now());
        });
    }

    public function scopePast($query)
    {
        return $query->whereHas('event', function($q) {
            $q->where('start_date', '<=', now());
        });
    }

    // Helper methods
    public function markAsScanned()
    {
        $this->update([
            'status' => 'scanned',
            'scanned_at' => now()
        ]);
    }

    public function markAsExpired()
    {
        $this->update(['status' => 'expired']);
    }

    public function isScanned(): bool
    {
        return $this->status === 'scanned';
    }

    public function isExpired(): bool
    {
        return $this->status === 'expired';
    }

    public function isUpcoming(): bool
    {
        return $this->event && $this->event->date > now();
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'not_scanned' => 'Not Scanned',
            'scanned' => 'Scanned',
            'expired' => 'Expired',
            'cancelled' => 'Cancelled',
            default => 'Unknown'
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'not_scanned' => 'text-blue-500',
            'scanned' => 'text-green-500',
            'expired' => 'text-red-500',
            'cancelled' => 'text-gray-500',
            default => 'text-gray-400'
        };
    }
}
