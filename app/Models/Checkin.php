<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendee_id',
        'scanned_by_user_id'
    ];

    public $timestamps = false; // Check-in is a single point in time

    protected $casts = [
        'created_at' => 'datetime'
    ];

    // Relationships
    public function attendee()
    {
        return $this->belongsTo(Attendee::class);
    }

    public function scannedBy()
    {
        return $this->belongsTo(User::class, 'scanned_by_user_id');
    }
}
