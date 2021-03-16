<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
  public function sendMail(Request $request)
  {
    dd($request->email);
    $details = [
          'title' => 'Mail from ItSolutionStuff.com',
          'body' => 'This is for testing email using smtp'
        ];

        \Mail::to('pdmyh595@gmail.com')->send(new \App\Mail\MyTestMail($details));
        
        dd("Email is Sent.");
  }
}
