<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request) {
        try {
           $request->validate([
                'content' => 'required',
                'ticket_id' => 'required'
            ]); 

            Message::create([
                'content' => $request->content,
                'ticket_id' => $request->ticket_id,
                'author_id' => auth()->user()->id
            ]);

            return response()->json(['msg' => 'Message sent!'], 200);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error sending message'], 406);
        }
        
    }
}
