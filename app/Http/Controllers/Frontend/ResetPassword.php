<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class ResetPassword extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'phone_no' => ['required', 'min:11', 'max:11'],
            'password' => ['required', 'starts_with:03','confirmed', Rules\Password::defaults()],
        ]);
        $user = User::where('phone_no', $request->phone_no)->first();
        if (!$user) {
            abort(403);
        }
        $user->update([
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60)
        ]);
        event(new PasswordReset($user));
        return redirect()->route('login');
    }
}
