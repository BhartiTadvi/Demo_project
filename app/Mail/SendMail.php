<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\EmailTemplate;
use replace;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
     public $Userdata;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Userdata)
    {
        //
         $this->Userdata = $Userdata;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

      $viewtemplates = EmailTemplate::where('template_key',$this->Userdata['template_key'])->get();
        foreach($viewtemplates as $template)
        {
        $template = htmlspecialchars_decode($template->templatecontent);
        }
        $template = $this->replace($template,$this->Userdata);
       return $this->from('bhartitadvi081@gmail.com')->view('mail_template')->with('template',$template);

    }
    public function replace($template,$Userdata)
    {
            foreach( $Userdata as $key => $data)
            {
            $template = str_replace('{{'.$key.'}}', $data,$template);     
            }
            return $template;
    }
}
