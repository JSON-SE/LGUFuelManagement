<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SavedAbandonedCartNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $user;
    public $cart;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $cart)
    {
        $this->user = $user;
        $this->cart = $cart;
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
            ->subject('Alert for Saved/Abandoned Cart')
            ->view('emails.abandoned-savecart', [
                'cart_id' => $this->cart->cart_id ?? '',
                'first_name' => $this->user['first_name'] ?? '',
                'last_name' => $this->user['last_name'] ?? '',
                'email' => $this->user['email'] ?? '',
                'cart_amount' => ((float)$this->cart->cart_amount -  (float)$this->cart->cart_item_discount),
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
