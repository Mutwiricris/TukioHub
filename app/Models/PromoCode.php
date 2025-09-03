<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'max_uses',
        'used_count',
        'valid_from',
        'valid_until',
        'is_active'
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
        'is_active' => 'boolean'
    ];

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Methods
    public function isValid()
    {
        return $this->is_active
            && $this->valid_from <= now()
            && $this->valid_until >= now()
            && ($this->max_uses === null || $this->used_count < $this->max_uses);
    }
}
