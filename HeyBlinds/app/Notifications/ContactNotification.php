<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $contact;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
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
                    ->subject('HeyBlinds-contact message.')
                    ->view('emails.contact',[
                    'data' => $this->contact,
                    // 'name' => $this->contact['first_name'].' '.$this->contact['last_name'] ?? '',
                    //  'email' => $this->contact['email'],
                    //  'phone_number' => $this->contact['phone_number'] ?? '',
                    //  'order_number' => $this->contact['order_number'] ?? '',
                    //  'preferred_communication' => $this->contact['preferred_communication'] ?? '',
                    //  'message' => $this->contact['message'] ?? '',
                    //  'reason' => $this->contact['contact_reason'] ?? '',
                       
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
