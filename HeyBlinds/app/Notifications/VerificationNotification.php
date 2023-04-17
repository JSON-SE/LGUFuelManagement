<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class VerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $cart_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cart_id)
    {
        $this->cart_id =  $cart_id;
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
      if($this->cart_id){
            $verifyUrl = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(1440),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                    'cart_id' => $this->cart_id ?? '',
                ]
            );
            return (new MailMessage)
            ->subject('Verify your email address')
            ->view('emails.verify-email',[
                'url' => $verifyUrl,
                'user' => $notifiable,
                'cart_id' => $this->cart_id ?? '',
            ]);
        }
        $verifyUrl = URL::temporarySignedRoute(
                'verification.verify.registration',
                Carbon::now()->addMinutes(60),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
            return (new MailMessage)
            ->subject('Verify your email address')
            ->view('emails.verify-email',[
                'url' => $verifyUrl,
                'user' => $notifiable,
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
