<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'text',
        'type',
        'is_required',
        'options'
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'options' => 'array'
    ];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
