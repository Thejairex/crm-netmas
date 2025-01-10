<?php

namespace App\Listeners;

use App\Events\PointsUpdated;
use App\Services\RankService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateRank
{
    protected $rankService;
    /**
     * Create the event listener.
     */
    public function __construct(RankService $rankService)
    {
        $this->rankService = $rankService;
    }

    /**
     * Handle the event.
     */
    public function handle(PointsUpdated $event): void
    {
        $this->rankService->updateUserRank($event->user);
    }
}
