<?php

namespace App\Http\Controllers;

use App\Models\demandeAcce;
use App\Http\Requests\StoredemandeAcceRequest;
use App\Http\Requests\UpdatedemandeAcceRequest;
use Illuminate\Http\Request;

class DemandeAcceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $damandes = demandeAcce::all();
        return response()->json(["data"=>$damandes],200);
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
        $demande = demandeAcce::create([
            "type"=>$request->type,
            "user_id"=>$request->user_id,

        ]);

        return response()->json($demande, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(demandeAcce $demandeAcce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(demandeAcce $demandeAcce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, demandeAcce $demandeAcce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($demandeAcce)
    {
        $demande = demandeAcce::findOrFail($demandeAcce);

        if (!$demande) {
            return response()->json(['message' => 'La demande d\'accès n\'existe pas.'], 404);
        }

        $demande->delete();
        return response()->json(['message' => 'La demande d\'accès a été supprimée avec succès.']);
    }

    public function finByIdUser($idUser)
    {
        $demande = DemandeAcce::where('user_id', $idUser)->first();
        if ($demande) {
            return response()->json(["type" => $demande->type], 200);
        } else {
            return response()->json(["message" => "User not found"], 404);
        }
    
    }
}
