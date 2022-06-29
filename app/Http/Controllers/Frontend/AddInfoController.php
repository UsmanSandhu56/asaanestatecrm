<?php

namespace App\Http\Controllers\Frontend;

use App\Models\AddInfo;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AddInfoController extends Controller
{
   public function adduserinfo(Request $request)
   {
    $validator = Validator::make($request->all(), [
        'email' => 'unique:add_infos,email',
    ]);
    if ($validator->fails()) {

        // get the error messages from the validator
        $messages = $validator->messages();

        // redirect our user back to the form with the errors from the validator
        return back()
            ->withErrors($validator);

    }
     else{
       $savedata = new AddInfo();
       $savedata->message = $request->message;
       $savedata->email = $request->email;
       $savedata->save();
       return redirect()
                ->back()
                ->with('success','Your request has been created!');
     }
   }
   public function addsubscription(Request $request)
   {
    //   dd($request->all());
      $validator = Validator::make($request->all(), [
        'email' => 'unique:subscriptions,email',
    ]);
    if ($validator->fails()) {

        // get the error messages from the validator
        $messages = $validator->messages();

        // redirect our user back to the form with the errors from the validator
        return back()
            ->withErrors($validator);

    }
    else{
        $savedata = new Subscription();
        $savedata->email = $request->email;

        $savedata->save();
        return redirect()
                 ->back()
                 ->with('success','Your are Subscribed');
      }
   }
}
