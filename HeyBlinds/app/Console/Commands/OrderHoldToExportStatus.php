<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\Order\Order;


class OrderHoldToExportStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert Hold State Order to Export Status';

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
     * @return int
     */
    public function handle()
    {

        $orders = Order::where("order_status","1")->get();

        $total = 0;
        foreach($orders as $order){
            if($order->created_at->diffInDays(now()) >= 1){
                $order->order_status = 9;
                $order->save();
                $total++;
            }
        }

        $this->info('Successfully Convert Hold Status Order to Export Status Orders after 24 Hours '.$total);
    }
}
