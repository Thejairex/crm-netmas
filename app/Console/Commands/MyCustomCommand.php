<?php

namespace App\Console\Commands;

use App\Services\MercadoPagoService;
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
        $mercadoPagoService = new MercadoPagoService();
        $mercadoPagoService->getPaymentById(1);
    }
}
