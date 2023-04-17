<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderReceived extends Mailable
{
    use Queueable, SerializesModels;




    public $orderId;
    public $price;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderId,$price)
    {
        $this->orderId = $orderId;
        $this->price = $price;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('HeyBlindsOrders@gmail.com')
                    ->subject("New Order Received")
                    ->view('emails.new-order-received');
    }
}
