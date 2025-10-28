<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;

    protected $fillable = [
        'manager_id',
        'name',
        'description',
        'website',
        'email',
        'phone',
        'logo_url',
        'is_verified',
        'is_primary'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_primary' => 'boolean'
    ];

    // Relationships
    public function manager()
    {
        return $this->belongsTo(OrganizerManager::class, 'manager_id');
    }

    // Keep backward compatibility with user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    // Scopes
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    public function scopeForManager($query, $managerId)
    {
        return $query->where('manager_id', $managerId);
    }
}
