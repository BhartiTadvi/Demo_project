<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderDetailmail;


class MailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

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
        //
      \Log::info("Cron is working fine!");

      $orderdetails=Order::whereRaw('Date(created_at) = CURDATE()')
                  ->get();
        $email="bhartitadvi081@gmail.com";
        Mail::to($email)->send(new OrderDetailmail($orderdetails));
         $this->info('Demo:Cron Cummand Run successfully!');

    }
}
