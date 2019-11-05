<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Cart;

class LoginController extends Controller
{ 
    use AuthenticatesUsers;
    protected $redirectTo = '/index';
    
    /** Get log in details for log in **/
     public function login(Request $request)
     {   
         $this->validate($request, [
          'e-mail' => 'required',
          'password1' => 'required']);
          
          $users = array(
          'email'  => $request->get('e-mail'),
          'password' => $request->get('password1'));
          
        if (Auth::attempt($users) && Cart::content()->count() == 0) {
          return redirect()->route('home_shopper')->with('success','Log in successfully done');
          
       } elseif (Auth::attempt($users) && Cart::content()->count() >= 1) {
        return redirect()->route('cart');
       }else{
           return back()->with('success', 'Wrong Login Details');
      }
     }
    /** Log out **/
    public function logout(Request $request) 
        {
             Auth::logout();
             return redirect()->route('login');
            
        }

}
