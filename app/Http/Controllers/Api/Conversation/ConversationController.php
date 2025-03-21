<?php

namespace App\Http\Controllers\Api\Conversation;

use App\Models\Chat;
use App\Models\User;
use App\Models\Message;
use App\Events\SendMessage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Conversation\ConversationRequest;

class ConversationController extends Controller
{

    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->Paginate(15);
        return response()->json(["users" => $users], 200);
    }

    public function getChat(Chat $chat)
    {
        if (! Gate::allows('get-my-chat', $chat)) {
            return response()->json([
                'message' => 'Unauthorized access.'
            ], 403);
        }

        $chat?->load('messages')->paginate(15);

        return response()->json(["chat" => $chat], 200);
    }

    public function setOnline()
    {
        Auth::user()->setOnline();
        return response()->json(['status' => true, 'message' => 'User is set to online']);
    }

    public function setOffline()
    {
        Auth::user()->setOffline();
        return response()->json(['status' => true, 'message' => 'User is set to offline']);
    }

    public function getStatus()
    {
        $isOnline = Auth::user()->isOnline;
        return response()->json([
            'status' => true,
            'message' => $isOnline ? 'User is currently online' : 'User is currently offline',
            'data' => ['isOnline' => $isOnline]
        ]);
    }

    public function sendMessage(ConversationRequest $request)
    {
        DB::beginTransaction();
        try
        {
            $chat_id = Chat::InsertIFNotExistsAndGetId($request->receiver_id, ['receiver_id' => $request->receiver_id, 'sender_id' => Auth::id()]);

            $message = Message::create([
                'chat_id' => $chat_id,
                'sender_id' => Auth::id(),
                'content' => $request->content
            ]);

            broadcast(new SendMessage($message , $request->receiver_id));

            DB::commit();
            return response()->json(['message' => 'Message sent successfully.']);

        }catch(\Exception $e){
            DB::rollback();
            \Log::error('An error occurred: ' . $e->getMessage());
        }
    }
}
