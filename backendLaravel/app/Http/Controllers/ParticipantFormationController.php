<?php

namespace App\Http\Controllers;

use App\Models\participantFormation;
use App\Http\Requests\StoreparticipantFormationRequest;
use App\Http\Requests\UpdateparticipantFormationRequest;
use Illuminate\Support\Facades\DB;

class ParticipantFormationController extends Controller
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
    public function store(StoreparticipantFormationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(participantFormation $participantFormation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(participantFormation $participantFormation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateparticipantFormationRequest $request, participantFormation $participantFormation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(participantFormation $participantFormation)
    {
        //
    }

    public function countParticipants()
    {
        $counts = ['participant' => []];

        for ($month = 9; $month <= 12; $month++) {
            $counts['participant'][] = participantFormation::whereMonth('created_at', $month)->whereYear('created_at', now()->subYear()->year)->count();
        }

        // Itérer sur les mois de janvier à juin de l'année suivante
        for ($month = 1; $month <= 6; $month++) {
            $counts['participant'][] = participantFormation::whereMonth('created_at', $month)->count();
        }

        return response()->json($counts);
    }

    public function getParticipantFormation($id)
    {
        $participants = participantFormation::where('formation4c_id', $id)->get();
        return response()->json($participants);
    }

    public function GetParticipation($UserId, $FormationId)
    {
        $participant = participantFormation::where('formation4c_id', $FormationId)
            ->where('user_id', $UserId)
            ->first();

        return response()->json($participant);
    }

    public function Participer($UserId, $FormationId)
    {
        participantFormation::create([
            "formation4c_id" => $FormationId,
            "user_id" => $UserId,
            "fichierEvaluation_id" => 16
        ]);

        return response()->json("Participant successfully registered for the formation.");
    }

    public function AnnulerParticiper($UserId, $FormationId)
    {
        // Find the participantFormation record to delete
        $participant = participantFormation::where('formation4c_id', $FormationId)
            ->where('user_id', $UserId)
            ->first();

        if ($participant) {
            // If the participant record exists, delete it
            $participant->delete();
            return response()->json("Participation for the formation successfully canceled.");
        } else {
            // If the participant record doesn't exist, return an appropriate message
            return response()->json("No participation found for the provided user and formation.");
        }
    }
}
