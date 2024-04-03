<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tour extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tours';

    protected $fillable = [
        'name',
        'startingDate',
        'endingDate',
        'price',
        'travelId'
    ];

    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class, "travelId");
    }
}
