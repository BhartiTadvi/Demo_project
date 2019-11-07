<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Cart;
use Socialite;
use App\User;

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
   //  public function redirectToGoogle()

   //  {
   //      return Socialite::driver('google')->redirect();

   //  }

   //  public function handleGoogleCallback()
   //  {
   //      try {
   //          $user = Socialite::driver('google')->user();
   //          $finduser = User::where('google_id', $user->id)->first();

   //       if($finduser){
   //              Auth::login($finduser);
            

   //              return redirect()->with()->route('home_shopper');
   //               }
   //          else{
   //              $newUser = User::create([
   //                  'name' => $user->name,
   //                  'email' => $user->email,
   //                  'google_id'=> $user->id

   //              ]);

   //               Auth::login($newUser,true);
   //              return redirect()->back();
   //          }
   //      } catch (Exception $e) {

   //          return redirect('auth/google');

   //      }
   // }
     public function redirectToGoogle()
    {
         return Socialite::driver('google')->redirect();
    }
   
    public function handleGoogleCallback()
    {
      $user = Socialite::driver('google')->user();
      dd($user);
 
        
    }
    private function findOrCreateUser($googleUser)
    {
        if ($authUser = User::where('google_id', $googleUser->id)->first()) {
            return $authUser;
        }
        return User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            
        ]);
    }

    /** Log out **/
    public function logout(Request $request) 
        {
             Auth::logout();
             return redirect()->route('login');
            
        }

}
