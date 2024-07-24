<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($emmetteur_id, $recepteur_id)
    {
        $messages = Message::whereIn('emmetteur_id', [$emmetteur_id, $recepteur_id])
            ->whereIn('recepteur_id', [$emmetteur_id, $recepteur_id])
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($messages);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'emmetteur_id' => 'required|exists:users,id',
            'recepteur_id' => 'required|exists:users,id'
        ]);

        Message::create([
            'message' => $request->message,
            'emmetteur_id' => $request->emmetteur_id,
            'recepteur_id' => $request->recepteur_id
        ]);

        return response()->json(['message' => 'Message created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return response()->json(['message' => 'Message deleted successfully']);
    }
}
