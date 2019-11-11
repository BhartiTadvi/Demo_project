<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Cart;
use Socialite;
use App\User;
use Input;

class LoginController extends Controller
{ 
    use AuthenticatesUsers;
    protected $redirectTo = '/';
    
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
    public function redirectToGoogle()

    {
        return Socialite::driver('google')->redirect();

    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('email',$user->email)->first();
         if($finduser){
                 $finduser->google_id = $user->id;
                 $finduser->save();                  
                 Auth::login($finduser);
                 return redirect('/');
                 }
            else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id
                ]);
                 Auth::login($newUser,true);
                return redirect()->back();
            }
        } catch (Exception $e) {

            return redirect('login/google');

        }
   }
    
    /** Log out **/
    public function logout(Request $request) 
        {
             Auth::logout();
             return redirect()->route('login');
            
        }

}
