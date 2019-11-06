<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\EmailTemplate;

class OrderStatus extends Mailable
{
    use Queueable, SerializesModels;
    public $orderStatus;
     
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderStatus)
    {
            $this->orderStatus = $orderStatus;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $viewtemplates = EmailTemplate::where('template_key',$this->orderStatus['template_key'])->get();
        foreach($viewtemplates as $template)
        {
        $template = htmlspecialchars_decode($template->templatecontent);
        }
        $template = $this->replace($template,$this->orderStatus);
       return $this->from('bharti08@gmail.com')->view('mail_template')->with('template',$template);
    }
    public function replace($template,$orderStatus){
         foreach( $orderStatus as $key => $status_change)
         {
          $orderKey   = array('{{'.$key.'}}');
          $template = str_replace($orderKey,$status_change,$template);
         }
            return $template;
        }
}
