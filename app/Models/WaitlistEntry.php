<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitlistEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'notified_at'
    ];

    protected $casts = [
        'notified_at' => 'datetime'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // Methods
    public function markAsNotified()
    {
        $this->notified_at = now();
        $this->save();
    }

    public function isNotified()
    {
        return !is_null($this->notified_at);
    }
}
