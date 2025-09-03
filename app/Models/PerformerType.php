<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformerType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    // Relationships
    public function performers()
    {
        return $this->hasMany(Performer::class);
    }
}
