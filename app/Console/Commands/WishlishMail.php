<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UserWishlist;
use Illuminate\Support\Facades\Mail;
use App\Mail\Wishmail;

class WishlishMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wishlistmail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $wishlist=UserWishlist::get();
        $email="bhartitadvi081@gmail.com";
        Mail::to($email)->send(new Wishmail($wishlist));
    }
}
