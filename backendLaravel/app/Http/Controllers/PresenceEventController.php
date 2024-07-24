<?php

namespace App\Http\Controllers;

use App\Models\PresenceEvent;
use App\Models\User;
use App\Models\Evenement;
use App\Http\Requests\StorePresenceEventRequest;
use App\Http\Requests\UpdatePresenceEventRequest;

class PresenceEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePresenceEventRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PresenceEvent $presenceEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PresenceEvent $presenceEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresenceEventRequest $request, PresenceEvent $presenceEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PresenceEvent $presenceEvent)
    {
        //
    }
    public function getevenementByUserId($userId)
    {

        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'user not found'], 404);
        }
        $presenceEvent = PresenceEvent::where('user_id', $userId)->first();

        if (!$presenceEvent) {
            return response()->json(['message' => 'presenceEvent not found for this user', 'user_id' => $userId], 404);
        }
        $evenements = Evenement::where('id', $presenceEvent->evenement_id)->get();

        return response()->json($evenements);
    }

    public function getPresenceEvent($id){
        $participants = PresenceEvent::where('evenement_id', $id)->get();
        return response()->json($participants);
    }
}
