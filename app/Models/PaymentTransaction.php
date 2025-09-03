<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'reference_number',
        'payment_method',
        'status',
        'amount',
        'payment_details',
        'external_reference',
        'confirmed_at',
        'reversed_at',
        'notes'
    ];

    protected $casts = [
        'payment_details' => 'array',
        'confirmed_at' => 'datetime',
        'reversed_at' => 'datetime',
        'amount' => 'decimal:2'
    ];

    protected $attributes = [
        'status' => 'pending'
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

    public function userTickets(): HasMany
    {
        return $this->hasMany(UserTicket::class, 'payment_reference', 'reference_number');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeReversed($query)
    {
        return $query->where('status', 'reversed');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopeByMethod($query, $method)
    {
        return $query->where('payment_method', $method);
    }

    // Helper methods
    public function markAsConfirmed()
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now()
        ]);
    }

    public function markAsReversed($reason = null)
    {
        $this->update([
            'status' => 'reversed',
            'reversed_at' => now(),
            'notes' => $reason
        ]);
    }

    public function markAsFailed($reason = null)
    {
        $this->update([
            'status' => 'failed',
            'notes' => $reason
        ]);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function isReversed(): bool
    {
        return $this->status === 'reversed';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'reversed' => 'Reversed',
            'failed' => 'Failed',
            default => 'Unknown'
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'text-yellow-500',
            'confirmed' => 'text-green-500',
            'reversed' => 'text-red-500',
            'failed' => 'text-red-600',
            default => 'text-gray-400'
        };
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        return match($this->payment_method) {
            'mpesa' => 'M-Pesa',
            'card' => 'Credit/Debit Card',
            'bank_transfer' => 'Bank Transfer',
            'cash' => 'Cash Payment',
            default => 'Unknown'
        };
    }

    public function requiresManualConfirmation(): bool
    {
        return in_array($this->payment_method, ['cash', 'bank_transfer']);
    }

    public function getDefaultStatusForMethod(): string
    {
        return match($this->payment_method) {
            'cash' => 'pending',
            'bank_transfer' => 'pending',
            'mpesa' => 'pending', // Will be updated by callback
            'card' => 'pending', // Will be updated by callback
            default => 'pending'
        };
    }
}
