<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderShippingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;
    public $address;
    public $shipping;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order,$address,$shipping)
    {
        $this->order =  $order;
        $this->address =  $address;
        $this->shipping =  $shipping;
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
            ->bcc("HeyBlindsOrders@gmail.com")
            ->subject('Your HeyBlinds Order Has Shipped')
            ->view('emails.shipping-information', [
                'order' => $this->order,
                'address' => $this->address,
                'shipping' => $this->shipping,
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
