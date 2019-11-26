<?php

namespace App\Http\Controllers;
use App\Message;
use App\Events\MessageNotification;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
 
    public function index()
    {
        $user_id = Auth::user()->id;
        $data = array('user_id' => $user_id);
 
        return view('broadcast', $data);
    }
 
    public function send()
    {
        // ...
         
        // message is being sent
        $message = new Message;
        $message->setAttribute('from', 1);
        $message->setAttribute('to', 1);
        $message->setAttribute('message', 'Demo message from user 1 to user 2');
        $message->save();
         
        // want to broadcast NewMessageNotification event
        event(new MessageNotification($message));
        return back();
        // ...
    }
}
