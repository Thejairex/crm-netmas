<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ranks extends Model
{
    protected $table = 'ranks';
    protected $fillable = [
        'name',
        'description',
        'points_required',
        'next_rank_id',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function nextRank(): BelongsTo
    {
        return $this->belongsTo(Ranks::class, 'next_rank_id');
    }
}
