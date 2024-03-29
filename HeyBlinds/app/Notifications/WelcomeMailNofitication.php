<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeMailNofitication extends Notification implements ShouldQueue
{
    use Queueable;

    public $email;
    public $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email,$password)
    {
        $this->email =  $email;
        $this->password =  $password;
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
        // return (new MailMessage)
        //     ->line('The introduction to the notification.')
        //     ->action('Notification Action', url('/'))
        //     ->line('Thank you for using our application!');


        return (new MailMessage)
        ->from("admin@heyblinds.com")
        ->subject('Welcome to HeyBlinds')
        ->view('emails.welcome', [
            'email' => $this->email,
            'password' => $this->password,
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
