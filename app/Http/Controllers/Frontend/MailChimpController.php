<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Config;

class MailChimpController extends Controller
{
    public $mailchimp;
    public $listId = '534e604cfb';
  
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(\Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    /**Create mailchimp form **/
    public function manageMailChimp()
    {
        return view('frontend.mailchimp');
    }

    /**Subscribed **/
    public function subscribe(Request $request)
    {
      // dd($request->all);
     $this->validate($request, [
	    	'email' => 'required|email',
          ]);
      
        try {
            $this->mailchimp
            ->lists
            ->subscribe(
                $this->listId,
                ['email' => $request->input('email')]
            );
            return redirect()->back()->with('success','Email Subscribed successfully');
        } catch (\Mailchimp_List_AlreadySubscribed $e) {
            return redirect()->back()->with('error','Email is Already Subscribed');
        } catch (\Mailchimp_Error $e) {
        return redirect()->back()->with('error','Error from MailChimp');
        }
    }
    
   

}
