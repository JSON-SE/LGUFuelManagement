<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentFailedNotification extends Notification 
{
    use Queueable;
    public $response;
    public $request;
    public $current_url;
    public $cart;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($response,$request,$current_url,$cart)
    {
        $this->response = $response;
        $this->request =  $request;
        $this->current_url = $current_url;
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
                    ->subject('Payment Failure')
                    ->cc(['heyblinds.joe@gmail.com','heyblinds.martin@gmail.com','heyblinds.joy@gmail.com'])
                    ->view('emails.payment-failed',[
                        'user_name' => $this->request['shipping_first_name'].' ' . $this->request['shipping_last_name'],
                        'email' => $this->request['shipping_email'],
                        'phone_number' => $this->request['shipping_phone_number'],
                        'response' => $this->response,
                        'cart_full_path' => $this->current_url,
                        'cart_id' => $this->cart->cart_id,
                        'cart_amount' => $this->request['total_cart_purchase_price']
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
