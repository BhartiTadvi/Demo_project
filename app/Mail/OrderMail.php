<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\EmailTemplate;


class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
      public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        //
         $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $viewtemplates = EmailTemplate::where('template_key',$this->order['template_key'])->get();

       // dd($viewtemplates);
        foreach($viewtemplates as $template){

        $template = htmlspecialchars_decode($template->templatecontent);
            //$template='<h1>hello</h1>';
       // dd($template);
        }
        
       //$template='<h1>hello</h1>';


        $template = $this->replace($template,$this->order);


         // dd($template);

       return $this->from('bhartitadvi081@gmail.com')->view('mail_template')->with('template',$template);
    }
     public function replace($template,$order){
            

            foreach( $order as $key => $orderdetail)
            {
            $orderkey   = array('{{'.$key.'}}');



            $template = str_replace($orderkey,$orderdetail,$template);

            // dd($template);     
            }
         // dd($order);
            return $order;
        }
}
