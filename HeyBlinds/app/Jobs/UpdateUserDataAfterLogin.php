<?php

namespace App\Jobs;

use App\Models\Admin\Cart\Cart;
use App\Models\SampleCart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class UpdateUserDataAfterLogin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
//        $data = $this->data;
//            echo "hello thhere";
//            dd($data);

        if (!empty($data['cart_id']) && array_key_exists('cart_id', $data)){
            $cart = Cart::where('external_id', $data['cart_id'])->first();
            if (!empty($cart)){
                $cart->user_id = Auth::id();
                $cart->save();
            }
        }elseif (!empty($data['sample_cart_id']) && array_key_exists('sample_cart_id', $data)){
            $sampleCarts = SampleCart::where('external_id', $data['sample_cart_id'])->get();
            foreach ($sampleCarts as $sampleCart){
                if (!empty($sampleCart)){
                    $sampleCart->user_id = Auth::id();
                    $sampleCart->save();
                }
            }
        }
    }
}
