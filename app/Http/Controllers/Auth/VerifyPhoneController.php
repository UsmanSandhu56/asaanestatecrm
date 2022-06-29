<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyPhoneController extends Controller
{
    protected function verify()
    {
        return view('auth.verify-phone');
    }

    protected function verifyPhone(Request $request)
    {

    }
}
