<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoCall;
use App\Models\User;
use App\Events\SignalEvent;
use Illuminate\Support\Facades\Auth;

class VideoCallController extends Controller
{
    public function getUsers()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $users = User::where('id', '!=', Auth::id())->get(['id', 'name', 'role']);
        return response()->json($users);
    }
    
    public function initiateCall(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
        ]);

        $call = VideoCall::create([
            'caller_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'status' => 'pending',
        ]);

        broadcast(new SignalEvent([
            'type' => 'call_request',
            'caller_id' => Auth::id(),
            'caller_name' => Auth::user()->name,
            'receiver_id' => $request->receiver_id,
            'call_id' => $call->id,
        ]));

        return response()->json(['message' => 'Call initiated', 'call_id' => $call->id], 201);
    }

    public function acceptCall(Request $request)
    {
        $request->validate(['call_id' => 'required|exists:video_calls,id']);
    
        $call = VideoCall::where('id', $request->call_id)
            ->where('receiver_id', Auth::id()) 
            ->first();
    
        if (!$call) return response()->json(['error' => 'Call not found'], 404);
    
        $call->update(['status' => 'accepted']);
    
        broadcast(new SignalEvent([
            'type' => 'call_accepted',
            'call_id' => $call->id,
            'receiver_id' => Auth::id(),
            'receiver_name' => Auth::user()->name,
        ]));
    
        return response()->json(['message' => 'Call accepted']);
    }
    
    public function rejectCall(Request $request)
    {
        $request->validate(['call_id' => 'required|exists:video_calls,id']);

        $call = VideoCall::where('id', $request->call_id)->where('receiver_id', Auth::id())->first();
        if (!$call) return response()->json(['error' => 'Call not found'], 404);

        $call->update(['status' => 'rejected']);

        broadcast(new SignalEvent([
            'type' => 'call_rejected',
            'call_id' => $call->id,
        ]));

        return response()->json(['message' => 'Call rejected']);
    }

    public function signal(Request $request)
    {
        $request->validate(['type' => 'required|string', 'data' => 'required']);

        broadcast(new SignalEvent($request->all()));

        return response()->json(['status' => 'sent']);
    }
}
