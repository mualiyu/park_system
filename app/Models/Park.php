<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Park extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'location',
    ];

    public function spaces(): HasMany
    {
        return $this->hasMany(Space::class);
    }
}
