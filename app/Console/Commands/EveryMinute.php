<?php

namespace App\Console\Commands;

use App\Http\Controllers\ShipmentController;
use Illuminate\Console\Command;
use App\Order;

class EveryMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update shipping Status every minute';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $update = new ShipmentController();
//        $update->get_shipment();
        Order::where('shipment_status','updated')->first()->update([
            'shipment_status' => 'cleared'
        ]);
        $this->info('Shipment watching regularly');
    }
}
