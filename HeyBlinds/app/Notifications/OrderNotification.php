<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $billingAddress;
    public $shippingAddress;
    public $cartItems;
    public $sumOfQty;
    public $purchasePrice;
    public $cart;
    public $coupon;
    public $cartItemsCount;
    public $order;
    public $promo_items;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($billingAddress,$shippingAddress,
        $cartItems,$sumOfQty,
        $purchasePrice,$cart,
        $coupon,$cartItemsCount,
        $order,$promo_items)
    {
        $this->billingAddress = $billingAddress;
        $this->shippingAddress = $shippingAddress;
        $this->cartItems =  $cartItems;
        $this->sumOfQty = $sumOfQty;
        $this->purchasePrice = $purchasePrice;
        $this->cart = $cart;
        $this->coupon = $coupon;
        $this->cartItemsCount = $cartItemsCount;
        $this->order = $order;
        $this->promo_items =  $promo_items;

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
            ->subject('Order created successfully | '.$this->order['order_id'])
            ->view('emails.order-confirmation', [
                'billingAddress' => $this->billingAddress,
                'shippingAddress' => $this->shippingAddress,
                'cartItems' => $this->cartItems,
                'sumOfQty' => $this->sumOfQty,
                'purchasePrice' =>$this->purchasePrice,
                'cart' =>$this->cart,
                'coupon' =>$this->coupon,
                'cartItemsCount' =>$this->cartItemsCount,
                'order' => $this->order,
                'promo_items' =>  $this->promo_items
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
