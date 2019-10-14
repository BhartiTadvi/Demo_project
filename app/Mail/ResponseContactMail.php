<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use  App\EmailTemplate;

class ResponseContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $responsemail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($responsemail)
    {
        //
         $this->responsemail = $responsemail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $viewtemplates = EmailTemplate::where('template_key',$this->responsemail['template_key'])->get();
        foreach($viewtemplates as $template){
        $template = htmlspecialchars_decode($template->templatecontent);
        }
        $template = $this->replace($template,$this->responsemail);
       return $this->from('bhartitadvi081@gmail.com')->view('mail_template')->with('template',$template);
    }
     public function replace($template,$responsemail){
            foreach( $responsemail as $key => $response_mail)
            {
            $template = str_replace('{{'.$key.'}}', $response_mail,$template);     
            }
            return $template;
        }
}
