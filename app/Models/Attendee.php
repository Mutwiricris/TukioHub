<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Attendee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_item_id',
        'first_name',
        'last_name',
        'email',
        'ticket_code'
    ];

    protected static function booted()
    {
        static::creating(function ($attendee) {
            if (empty($attendee->ticket_code)) {
                $attendee->ticket_code = Str::uuid()->toString();
            }
        });
    }

    // Relationships
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function checkin()
    {
        return $this->hasOne(Checkin::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Methods
    public function isCheckedIn()
    {
        return $this->checkin()->exists();
    }

    public function generateTicketCode()
    {
        $this->ticket_code = Str::uuid()->toString();
        $this->save();
        return $this->ticket_code;
    }
}
