<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;

class FormController extends Controller
{
    public function contact(Request $request){
        $this->validate($request, [
    		'subject'	=>	'required|min:3|max:30',
    		'email'		=>	'required|min:9|max:50',
    		'phone'	    =>	'required|min:11|max:11',
    		'message'	=>	'required|min:6|max:512',
    	]);

        $ticket = new Ticket;
        $ticket->email = $request->email;
        $ticket->phone = $request->phone;
        $ticket->subject = $request->subject;
        $ticket->message = $request->message;
        $ticket->status = 1;
        $ticket->save();

        $request->session()->flash('alert-success', 'پیغام شما با موفقیت ثبت شد. کارشناسان ما در اسرع وقت با شما تماس حاصل خواهند نمود.');
        return back();
    }
}
