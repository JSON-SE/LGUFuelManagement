<?php

namespace App\Notifications;

use App\Models\Admin\Product\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $review;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($review)
    {
        $this->review =  $review;
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
                    ->subject('feedback')
                    ->view('emails.review',[
                        'title_review' => $this->review->title_review,
                        'rating_point' => $this->review->rating_point,
                        'review' => $this->review->review,
                        'name' => ucfirst($this->review->name),
                        'product_name' => $this->productName($this->review->product_id) ?? '',
                        'email' => $this->review->email ??  '',
                        'city' => $this->review->city,
                        'province' => $this->review->province,
                        'customer_suggestion' => $this->review->customer_suggestion ?? ''
                ]);
                    
    }
    public function productName($product_id = null){
        $product = Product::find($product_id);
        return $product->name ?? '';
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
