<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performer extends Model
{
    use HasFactory;

    protected $fillable = [
        'performer_type_id',
        'name',
        'bio',
        'image_url',
        'website',
        'social_media',
        'is_featured'
    ];

    protected $casts = [
        'social_media' => 'array',
        'is_featured' => 'boolean'
    ];

    // Relationships
    public function performerType()
    {
        return $this->belongsTo(PerformerType::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_performers');
    }
}
