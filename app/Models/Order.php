<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'currency',
        'status',
        'payment_status',
        'promo_code_id'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2'
    ];

    protected static function booted()
    {
        static::created(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'TH-' . date('Y') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT);
                $order->save();
            }
        });
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }

    // Scopes
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    // Methods
    public function generateOrderNumber()
    {
        $this->order_number = 'TH-' . date('Y') . '-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
        $this->save();
        return $this->order_number;
    }

    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }

    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->where('payment_status', 'completed')->sum('amount');
    }
}
