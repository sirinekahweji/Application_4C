<?php

namespace App\Http\Controllers;

use App\Models\Attestation;
use App\Http\Requests\StoreAttestationRequest;
use App\Http\Requests\UpdateAttestationRequest;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class AttestationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attestations = Attestation::all();
        return response()->json(["data"=>$attestations],200);
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

        Attestation::Create([
            "nom" => $request->nom,
            "type" => $request->type,
            "description" => $request->description,
            "image" => $request->image,
            "choix" => $request->choix,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attestation $attestation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attestation=Attestation::find($id);
        return response()->json($attestation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $attestation = Attestation::findOrFail($id);
        $attestation->update($request->all());
        return response()->json(["message" => "Attestation mis à jour avec succès"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attestation $attestation)
    {
        //
    }

}
