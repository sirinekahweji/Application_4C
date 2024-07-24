<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use App\Http\Requests\StoreSpecialiteRequest;
use App\Http\Requests\UpdateSpecialiteRequest;


class SpecialiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialites = Specialite::all();
        return response()->json(["data"=>$specialites],200);
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
    public function store(StoreSpecialiteRequest $request)
    {
        Specialite::create([
            "nom"=>$request->nom,
            "abreviation"=>$request->abreviation,
            "departement_id"=>$request->departement_id
        ]);

        return response()->json(["message"=>"Specialité Created"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialite $specialite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialite $specialite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecialiteRequest $request,  $id)
    {
        $Specialite = Specialite::find($id);
        if (!$Specialite) {
            return response()->json(["message" => "Specialite  Not Found"], 404);
        }
        $Specialite->nom = $request->nom;
        $Specialite->abreviation = $request->abreviation;
        $Specialite->departement_id = $request->departement_id;

        
        
        // Sauvegarder les modifications
        $Specialite->save();
        
        // Retourner une réponse
        return response()->json(["message" => "Specialite updated"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialite $specialite)
    {
        if($specialite){
            $specialite->delete();
            return response()->json(["message"=>"Delete With Success"],200);
        }else{
            return response()->json(["message"=>"Spécialité Not Found"],404);
        }
    }

    public function findById($id)
    {
        $Specialite = Specialite::find($id);
        if($Specialite){
            return response()->json(["data"=>$Specialite],200);
        }
        else{
            return response()->json(["message"=>"Specialite Not Found"],404);
        }
    }
}
