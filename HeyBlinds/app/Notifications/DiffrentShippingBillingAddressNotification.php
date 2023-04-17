<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DiffrentShippingBillingAddressNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $order;
    public $shippingAddress;
    public $billingAddress;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order,$shippingAddress,$billingAddress)
    {
        $this->order = $order;
        $this->billingAddress = $billingAddress;
        $this->shippingAddress = $shippingAddress;

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
        ->subject('Fraud Alert: Different Bill/ship addresses')
                ->view('emails.shipping-billing-mismatch',[
                    'order_id' => $this->order->order_id ?? '',
                    'billingAddress' => $this->billingAddress,
                    'shippingAddress' => $this->shippingAddress,
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
