<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'event_type_id',
        'venue_id',
        'organizer_id',
        'name',
        'title',
        'description',
        'start_date',
        'end_date',
        'image_url',
        'status',
        'max_capacity',
        'is_featured',
        'slug'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_featured' => 'boolean'
    ];

    // Relationships
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
    /**
     * Get all user tickets for this event.
     */
    public function userTickets()
    {
        return $this->hasMany(\App\Models\UserTicket::class);
    }

    public function eventSessions()
    {
        return $this->hasMany(EventSession::class);
    }

    // Alias for backward compatibility
    public function sessions()
    {
        return $this->hasMany(EventSession::class);
    }

    public function performers()
    {
        return $this->belongsToMany(Performer::class, 'event_performers');
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class, 'event_sponsors');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function eventStats()
    {
        return $this->hasMany(EventStat::class);
    }

    public function bookings()
    {
        return $this->hasManyThrough(Booking::class, Ticket::class);
    }

    // Scopes
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'published');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
