<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'latitude',
        'longitude',
        'capacity',
        'description',
        'image_url'
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];

    // Relationships
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    // Accessors
    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->state} {$this->postal_code}, {$this->country}";
    }
}
