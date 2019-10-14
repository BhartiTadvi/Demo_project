<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\UserWishList;

class Wishmail extends Mailable
{
    use Queueable, SerializesModels;
     public $wishlist;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($wishlist)
    {
        //
        $this->wishlist = $wishlist;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    $wishlist=UserWishList::with('userDetail','productDetail')->get();
        return $this->view('wishlist_mail_template',compact('wishlist'));
    }
}
