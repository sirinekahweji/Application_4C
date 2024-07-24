<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use App\Http\Requests\StoreCompetenceRequest;
use App\Http\Requests\UpdateCompetenceRequest;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competences = Competence::all();
        return response()->json(["data"=>$competences],200);
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
    public function store(StoreCompetenceRequest $request)
    {
        Competence::create([
            "nom"=>$request->nom,
            "niveau"=>$request->niveau,
            "cv_id"=>$request->cv_id,
        ]);

        return response()->json(['message' => 'Competance Ajouter avec succès.'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Competence $competence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competence $competence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompetenceRequest $request,  $id)
    {
        try {
            $competence = Competence::findOrFail($id);
            $competence->update([

                'nom'     => $request->nom,
                'niveau'  => $request->niveau,
                'cv_id'   => $request->cv_id,
               
            ]);
         
            
            return response()->json(['message' => 'competence modifiée avec succès.'], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response()->json(['message' => 'competence non trouvée.'], 404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idCompetence)
    {
        $competence = Competence::findOrFail($idCompetence);
        $competence->delete();
        return response()->json(['message' => 'competence Supprimer avec succès.'], 200);

    }
    public function finById( $idCompetence)
    {
        $Competance = Competence::findOrFail($idCompetence);
        if($Competance){
            return response()->json(["data"=>$Competance],200);
        }else{
            return response()->json(["message"=>"Competance Not Found"],404);
        }
    }
    public function getCompetencesByIdCV( $idCV)
    {
        $competences= Competence::where('cv_id', $idCV )->get();
        if($competences){
            return response()->json(["data" => $competences], 200);
        }
        else{
            return response()->json(["message"=>" Competence Not Found"],404);
        }

    }
}
