<?php

namespace App\Services;

use App\Models\Ranks;
use App\Models\User;
use Log;

class RankService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }
    public function updateUserRank(User $user)
    {
        $nextRank = $user->rank->nextRank;

        if ($user->points >= $nextRank->points) {
            $user->rank()->associate($nextRank);
            $user->save();
        }

    }

    public function startUserRank(User $user)
    {
        if ($user->role !== 'admin') {
            Log::info("Starting supplier rank for customer");
            $user->role = 'supplier';
        }

        $nextRank = $user->rank->nextRank;
        $user->rank()->associate($nextRank);
        $user->save();
    }
}
