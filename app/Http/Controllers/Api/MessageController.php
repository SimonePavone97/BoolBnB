<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

        $newMessage = new Message();
        $newMessage->apartment_id = $data['apartment_id'];
        $newMessage->sender = $data['sender'];
        $newMessage->email = $data['email'];
        $newMessage->content = $data['content'];
        $newMessage->save();

        return response()->json([
            "success"=>true
        ]);
    }
}
