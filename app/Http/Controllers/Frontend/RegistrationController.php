<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    /** Create register form**/

     public function index()
    {
        return view('register');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('frontend.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required']);
        $user= User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])]);
        $Userdata= array(
        'email'  => $request->get('email'),
        'password' => $request->get('password'),
        'template_key' => "user_registration_mail");
        Mail::to($request['email'])->send(new SendMail($Userdata));
       $Userdata1= array(
        'email'  => $request->get('email'),
        'template_key' => "email_template_key");
        $email="bhartitadvi081@gmail.com";
       Mail::to($email)->send(new SendMail($Userdata1));
       return redirect()->route('loginuser')->with('success','Registration done successfully');
   }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
}
