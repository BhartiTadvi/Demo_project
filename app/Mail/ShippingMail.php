<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\EmailTemplate;

class ShippingMail extends Mailable
{
    use Queueable, SerializesModels;
     public $shippingorder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($shippingorder)
    {
        //
         $this->shippingorder = $shippingorder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $viewtemplates = EmailTemplate::where('template_key',$this->shippingorder['template_key'])->get();
        
        foreach($viewtemplates as $template){
        $template = htmlspecialchars_decode($template->templatecontent);
        }
        $template = $this->replace($template,$this->shippingorder);
       return $this->from('bhartitadvi081@gmail.com')->view('mail_template')->with('template',$template);
    }
      
      public function replace($template,$shippingorder)
      {
            foreach( $shippingorder as $key => $shipping_order)
            {
            $template = str_replace('{{'.$key.'}}', $shipping_order,$template);     
            }
            return $template;
     }
}
