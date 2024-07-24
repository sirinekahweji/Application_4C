<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experience::all();
        return response()->json(["data"=>$experiences],200);
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
    public function store(StoreExperienceRequest $request)
    {
        Experience::create([
            'poste' => $request->poste,
            'entreprise' => $request->entreprise,
            'lieu' => $request->lieu,
            'dateDebut' => $request->dateDebut,
            'dateFin' => $request->dateFin,
            'description' => $request->description,
            "cv_id"=>$request->cv_id,
        ]);

        return response()->json(['message' => 'Experience Ajouter avec succès.'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExperienceRequest $request, $idExperience)
    {
        try {
            $experience = Experience::findOrFail($idExperience);
            $experience->update([

                'poste' => $request->poste,
                'entreprise' => $request->entreprise,
                'lieu' => $request->lieu,
                'dateDebut' => $request->dateDebut,
                'dateFin' => $request->dateFin,
                'description' => $request->description,
                "cv_id"=>$request->cv_id,
            ]);
         
            
            return response()->json(['message' => 'Expérience modifiée avec succès.'], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response()->json(['message' => 'Expérience non trouvée.'], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $idExperience)
    {
        $experience = Experience::findOrFail($idExperience);
        
        $experience->delete();

        return response()->json(['message' => ' Experience Supprimer avec succès.'], 200);
    }

    public function finById( $idExperience)
    {
        $experience = Experience::findOrFail($idExperience);
        if($experience){
            return response()->json(["data"=>$experience],200);
        }else{
            return response()->json(["message"=>"Experience Not Found"],404);
        }
    }

    public function getAllExperiencesByCVID( $idCv)
    {
        $experiences = Experience::where('cv_id', $idCv )->get();
        if($experiences){
            return response()->json(["data" => $experiences], 200);
        }else{
            return response()->json(["message"=>"Experiences Not Found"],404);
        }

    }
}
