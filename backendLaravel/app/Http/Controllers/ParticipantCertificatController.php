<?php

namespace App\Http\Controllers;

use App\Models\participantCertificat;
use App\Http\Requests\StoreparticipantCertificatRequest;
use App\Http\Requests\UpdateparticipantCertificatRequest;

class ParticipantCertificatController extends Controller
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
    public function store(StoreparticipantCertificatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(participantCertificat $participantCertificat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(participantCertificat $participantCertificat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateparticipantCertificatRequest $request, participantCertificat $participantCertificat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(participantCertificat $participantCertificat)
    {
        //
    }

    public function countParticipants()
    {
        $counts = ['participant' => []];

        for ($month = 9; $month <= 12; $month++) {
            $counts['participant'][] = participantCertificat::whereMonth('created_at', $month)->whereYear('created_at', now()->subYear()->year)->count();
        }

        // Itérer sur les mois de janvier à juin de l'année suivante
        for ($month = 1; $month <= 6; $month++) {
            $counts['participant'][] = participantCertificat::whereMonth('created_at', $month)->count();
        }

        return response()->json($counts);
    }

    public function getParticipantCertificat($id){
        $participants = ParticipantCertificat::where('certificat4c_id', $id)->get();
        return response()->json($participants);
    }

    public function GetParticipation($UserId, $CertifId)
    {
        $participant = ParticipantCertificat::where('certificat4c_id', $CertifId)
            ->where('user_id', $UserId)
            ->first();

        return response()->json($participant);
    }

    public function Participer($UserId, $CertifId)
    {
        ParticipantCertificat::create([
            "certificat4c_id" => $CertifId,
            "user_id" => $UserId,
        ]);

        return response()->json("Participant successfully registered for the Certif.");
    }

    public function AnnulerParticiper($UserId, $CertifId)
    {
        // Find the participantCertif record to delete
        $participant = ParticipantCertificat::where('certificat4c_id', $CertifId)
            ->where('user_id', $UserId)
            ->first();

        if ($participant) {
            // If the participant record exists, delete it
            $participant->delete();
            return response()->json("Participation for the Certif successfully canceled.");
        } else {
            // If the participant record doesn't exist, return an appropriate message
            return response()->json("No participation found for the provided user and Certif.");
        }
    }
}
