<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'event_id',
        'rating',
        'comment'
    ];

    protected $casts = [
        'rating' => 'integer'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Scopes
    public function scopeHighRated($query)
    {
        return $query->where('rating', '>=', 4);
    }

    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }
}
