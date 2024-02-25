<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Http\Resources\ChatMessageResource;
use App\Http\Resources\UserResource;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatMessageController extends Controller
{
  public function sendMessage(Request $request, $username)
  {
    $request->validate([
      'content' => ['required'],
    ]);
    $user = Auth::user();
    if ($user->username === $username) {
      abort(400);
    }
    $receiver = User::where('username', $username)->first();

    $chat_room = ChatRoom::where([
      ['user1_id', $user->id],
      ['user2_id', $receiver->id],
    ])->orWhere([
      ['user2_id', $user->id],
      ['user1_id', $receiver->id],
    ])->first();

    if (!$chat_room) {
      $chat_room = new ChatRoom;
      $chat_room->user1_id = $user->id;
      $chat_room->user2_id = $receiver->id;
      $chat_room->save();
    }

    $message = new ChatMessage;
    $message->sender_id = $user->id;
    $message->receiver_id = $receiver->id;
    $message->room_id = $chat_room->id;
    $message->content = $request->content;
    $message->save();
    event(new SendMessage($message));
    return response()->json(new ChatMessageResource($message), 201);
  }

  public function receiveMessage(Request $request, $username)
  {
    $receiver = User::where('username', $username)->first();
    $sender = Auth::user();
    if ($sender->username === $username) {
      return redirect('/');
    }
    $messagesByAuth = ChatMessage::where([
      ['sender_id', $sender->id],
      ['receiver_id', $receiver->id],
    ])->get();
    $messagesByRequested = ChatMessage::where([
      ['sender_id', $receiver->id],
      ['receiver_id', $sender->id],
    ])->get();
    $messages = $messagesByAuth->concat($messagesByRequested)->sortBy('created_at');
    return Inertia::render('Chat', [
      'user' => new UserResource($receiver),
      'messages' => ChatMessageResource::collection($messages),
    ]);
  }
}
