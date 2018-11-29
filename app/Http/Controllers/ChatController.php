<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required', 
            'message' => 'required', 
            'time' => 'required'
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $chat = Chat::create($data);
        if($chat) {
            return $chat;
        } else {
            response('failed', 500);
        }
    }

    public function jsonData(Request $request)
    {
        return Chat::where('course_id', $request->id)->with('user')->get();
    }
}
