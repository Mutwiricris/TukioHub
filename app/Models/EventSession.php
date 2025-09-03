<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSession extends Model
{
    use HasFactory;

    protected $table = 'event_sessions';

    protected $fillable = [
        'event_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'speaker',
        'location'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Accessors
    public function getDurationAttribute()
    {
        return $this->start_time->diffInMinutes($this->end_time);
    }

    public function getFormattedTimeAttribute()
    {
        return $this->start_time->format('H:i') . ' - ' . $this->end_time->format('H:i');
    }

    // Scopes
    public function scopeUpcoming($query)
    {
        return $query->where('start_time', '>', now());
    }

    public function scopeToday($query)
    {
        return $query->whereDate('start_time', today());
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereDate('start_time', $date);
    }
}
