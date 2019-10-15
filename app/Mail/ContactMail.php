<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\EmailTemplate;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $contactmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactmail)
    {
        //
          $this->contactmail = $contactmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $viewtemplates = EmailTemplate::where('template_key',$this->contactmail['template_key'])->get();
        foreach($viewtemplates as $template)
        {
        $template = htmlspecialchars_decode($template->templatecontent);
        }
        
        $template = $this->replace($template,$this->contactmail);
       return $this->from('bhartitadvi081@gmail.com')->view('mail_template')->with('template',$template);
    }

    public function replace($template,$contactmail){
       foreach( $contactmail as $key => $contact_mail)
            {
            $template = str_replace('{{'.$key.'}}', $contact_mail,$template);     
            }
            return $template;
        }
}
