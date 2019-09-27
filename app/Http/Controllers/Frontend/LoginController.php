<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



use Illuminate\Http\Request;

use Auth;

class LoginController extends Controller
{ 
    use AuthenticatesUsers;

    protected $redirectTo = '/index';
    
   
   public function login(Request $request)
        {   
            
            $this->validate($request, [
            'e-mail' => 'required',
            'password1' => 'required',
          ]);
            $users = array(
            'email'  => $request->get('e-mail'),
          
            'password' => $request->get('password1')
            );


            if(Auth::attempt($users))
            {
             return redirect('/index');
            }

        else
        {
            
         return back()->with('error', 'Wrong Login Details');
        }
    }
       public function logout(Request $request) 
        {
             Auth::logout();
            return redirect('/loginuser');
        }




}
