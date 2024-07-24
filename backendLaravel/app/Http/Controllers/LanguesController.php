<?php

namespace App\Http\Controllers;

use App\Models\Langues;
use App\Http\Requests\StoreLanguesRequest;
use App\Http\Requests\UpdateLanguesRequest;

class LanguesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langues = Langues::all();
        return response()->json(["data"=>$langues],200);
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
    public function store(StoreLanguesRequest $request)
    {
        Langues::create([
            "nom"=>$request->nom,
            "niveau"=>$request->niveau,
            "cv_id"=>$request->cv_id,
        ]);
        return response()->json(['message' => 'Langue Ajouter avec succès.'], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Langues $langues)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Langues $langues)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguesRequest $request,  $id)
    {
        try {
            $langue = Langues::findOrFail($id);
            $langue->update([

                'nom'     => $request->nom,
                'niveau'  => $request->niveau,
                'cv_id'   => $request->cv_id,
               
            ]);
         
            
            return response()->json(['message' => 'Langue modifiée avec succès.'], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response()->json(['message' => 'Langue non trouvée.'], 404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $idlangue)
    {
        $langue = Langues::findOrFail($idlangue);
        $langue->delete();
        return response()->json(['message' => 'Langue Supprimer avec succès.'], 200);
    }

    public function findById( $idlangue)
    {
        $langue = Langues::findOrFail($idlangue);
        if($langue){
            return response()->json(["data"=>$langue],200);
        }else{
            return response()->json(["message"=>"langue Not Found"],404);
        }
    }
    public function getAllLangues( $idCV)
    {
        $langues = Langues::where('cv_id', $idCV )->get();
        if($langues){
            return response()->json(["data" => $langues], 200);
        }else{
            return response()->json(["message"=>"langues  Not Found"],404);
        }

    }

}
