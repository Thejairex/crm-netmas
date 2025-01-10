<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ranks extends Model
{
    protected $table = 'ranks';
    protected $fillable = [
        'name',
        'description',
        'min_points',
        'max_points',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
