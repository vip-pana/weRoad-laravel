<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Travel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'travels';

    protected $fillable = [
        'slug',
        'name',
        'description',
        'numberOfDays',
        'isPublic',
        'moods',
    ];

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, 'travelId');
    }
}
