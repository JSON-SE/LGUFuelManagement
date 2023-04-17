<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SampleOrderNotification extends Notification  implements ShouldQueue
{
    use Queueable;

    public $shipping;
    public $sampleCartProducts;
    public $allSampleCarts;
    public $name;
    public $order_id;
    public $promo;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($shipping,$sampleCartProducts,$allSampleCarts,$name,$order_id,$promo)
    {
        $this->shipping = $shipping;
        $this->sampleCartProducts = $sampleCartProducts;
        $this->allSampleCarts = $allSampleCarts;
        $this->name = $name;
        $this->order_id = $order_id;
        $this->promo = $promo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->bcc(["HeyBlindsOrders@gmail.com",'help@heyblinds.ca'])
        ->subject('Your HeyBlinds samples are on their way!')
        ->view('emails.sample-order-confirmation', [
            'order_id' => $this->order_id,
            'sampleCartProducts' => $this->sampleCartProducts,
            'allSampleCarts' => $this->allSampleCarts,
            'shipping' => $this->shipping,
            'name' => ucfirst($this->name),
            'promo_description' => $this->promo->content ?? ' ',
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
