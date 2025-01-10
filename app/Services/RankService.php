<?php

namespace App\Services;

use App\Models\Ranks;
use App\Models\User;

class RankService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

    public function updateUserRank(User $user) {
        $points = $user->balance_points;
        $rank = Ranks::where('min_points', '<=', $points)
                ->where('max_points', '>=', $points)
                ->first();

        $user->rank()->associate($rank);
        $user->save();

    }
}
