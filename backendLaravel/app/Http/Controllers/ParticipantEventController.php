<?php

namespace App\Http\Controllers;

use App\Models\ParticipantEvent;
use App\Http\Requests\StoreParticipantEventRequest;
use App\Http\Requests\UpdateParticipantEventRequest;

class ParticipantEventController extends Controller
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
    public function store(StoreParticipantEventRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ParticipantEvent $participantEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParticipantEvent $participantEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParticipantEventRequest $request, ParticipantEvent $participantEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParticipantEvent $participantEvent)
    {
        //
    }

    public function getParticipantEvent($id)
    {
        $participants = ParticipantEvent::where('evenement_id', $id)->get();
        return response()->json($participants);
    }

    public function GetParticipation($UserId, $EventId)
    {
        $participant = ParticipantEvent::where('evenement_id', $EventId)
            ->where('user_id', $UserId)
            ->first();

        return response()->json($participant);
    }

    public function Participer($UserId, $EventId)
    {
        ParticipantEvent::create([
            "evenement_id" => $EventId,
            "user_id" => $UserId,
        ]);

        return response()->json("Participant successfully registered for the Event.");
    }

    public function AnnulerParticiper($UserId, $EventId)
    {
        // Find the participantEvent record to delete
        $participant = ParticipantEvent::where('evenement_id', $EventId)
            ->where('user_id', $UserId)
            ->first();

        if ($participant) {
            // If the participant record exists, delete it
            $participant->delete();
            return response()->json("Participation for the Event successfully canceled.");
        } else {
            // If the participant record doesn't exist, return an appropriate message
            return response()->json("No participation found for the provided user and Event.");
        }
    }
}
