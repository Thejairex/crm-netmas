<?php

namespace App\Console\Commands;

use App\Models\Purchase;
use App\Services\MercadoPagoService;
use App\Services\PointsService;
use Illuminate\Console\Command;

class MyCustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing:getPayments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pointsService = new PointsService();
        $purchase = Purchase::latest()->first();
        $pointsService->earnPoints($purchase);
    }
}
