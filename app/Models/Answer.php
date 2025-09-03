<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendee_id',
        'question_id',
        'content'
    ];

    // Relationships
    public function attendee()
    {
        return $this->belongsTo(Attendee::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
