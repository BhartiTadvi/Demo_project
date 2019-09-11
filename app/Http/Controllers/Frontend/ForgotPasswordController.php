<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


class ForgotPasswordController extends Controller
{
    //
    use SendsPasswordResetEmails;
    
    public function __construct()
    {
        $this->middleware('guest');
    }
}
