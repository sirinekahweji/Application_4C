<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classe::all();
        return response()->json(["data"=>$classes],200);
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
    public function store(StoreClasseRequest $request)
    {
        Classe::create([
            "nom"=>$request->nom,
            "abreviation"=>$request->abreviation,
            "specialite_id"=>$request->specialite_id
        ]);

        return response()->json(["message"=>"Classe Created"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request,  $id)
    {
        
        $Classe = Classe::find($id);
        if (!$Classe) {
            return response()->json(["message" => "Classe  Not Found"], 404);
        }
        $Classe->nom = $request->nom;
        $Classe->abreviation = $request->abreviation;
        $Classe->specialite_id = $request->specialite_id;
        
        // Sauvegarder les modifications
        $Classe->save();
        
        // Retourner une réponse
        return response()->json(["message" => "Classe updated"], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        if($classe){
            $classe->delete();
            return response()->json(["message"=>"Delete With Success"],200);
        }else{
            return response()->json(["message"=>"Department Not Found"],404);
        }
    }

    public function findById($id)
    {
        $Classe = Classe::find($id);
        if($Classe){
            return response()->json(["data"=>$Classe],200);
        }
        else{
            return response()->json(["message"=>"Classe Not Found"],404);
        }
    }
}
