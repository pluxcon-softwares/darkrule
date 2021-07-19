<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessageBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MessageBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $title = "All Messages";

        $messages = MessageBoard::all();

        return view('admin.message-board')->with(['title' => $title, 'messages'=>$messages]);
    }

    public function viewMessage($id)
    {
        $message = MessageBoard::find($id);

        return response()->json(['message' => $message]);
    }

    public function createMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' =>  'required|max:200',
            'body'  =>  'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()]);
        }

        $message = new MessageBoard;
        $message->title = $request->title;
        $message->body = $request->body;
        $message->is_published = $request->is_published;
        $message->admin_id = Auth::user()->id;
        $message->save();

        return response()->json(['success' => 'Your message has been created!']);
    }

    public function editMessage($id)
    {
        $message = MessageBoard::find($id);

        return response()->json(['message' => $message]);
    }

    public function updateMessage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' =>  'required',
            'body'  =>      'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()]);
        }

        $message = MessageBoard::find($id);
        $message->title = $request->title;
        $message->body = $request->body;
        $message->is_published = $request->is_published;
        $message->save();

        return response()->json(['success' => "Message has been updated!"]);
    }

    public function deleteMessage($id)
    {
        $message = MessageBoard::find($id);
        $message->delete();

        return response()->json(['success' => "Message was deleted successfully!"]);
    }
}
