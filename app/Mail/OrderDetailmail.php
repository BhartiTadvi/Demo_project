<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order;


class OrderDetailmail extends Mailable
{
    use Queueable, SerializesModels;
    public $orderdetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderdetails)
    {
        //
        $this->orderdetails = $orderdetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $orderdetails=Order::with('user','orderDetail','products')->get();

        return $this->view('template',compact('orderdetails'));
    }
}
