<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
     protected $redirectTo = '/homeshopper';
     /** create reset password**/
     public function resetpassword(){
     	return view('frontend.passwords.email');
     }
}
