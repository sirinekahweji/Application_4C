<?php

namespace App\Http\Controllers;

use App\Models\FormationAcademique;
use App\Http\Requests\StoreFormationAcademiqueRequest;
use App\Http\Requests\UpdateFormationAcademiqueRequest;

class FormationAcademiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formationAcademique = FormationAcademique::all();
        return response()->json(["data"=>$formationAcademique],200);
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
    public function store(StoreFormationAcademiqueRequest $request)
    {
        FormationAcademique::create([
            'etablissement'   => $request->etablissement,
            'diplome'         => $request->diplome,
            'domaineEtude'    => $request->domaineEtude,
            'dateDebut'       => $request->dateDebut,
            'dateFin'         => $request->dateFin,
            'description'     => $request->description,
            'cv_id'           => $request->cv_id,
          
        ]);

        return response()->json(['message' => 'Formation Academique Ajouter avec succès.'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(FormationAcademique $formationAcademique)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormationAcademique $formationAcademique)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormationAcademiqueRequest $request,$idformationAcademique)
    {
        try {
            $formationAcd = FormationAcademique::findOrFail($idformationAcademique);
            $formationAcd->update([

                'etablissement'   => $request->etablissement,
                'diplome'         => $request->diplome,
                'domaineEtude'    => $request->domaineEtude,
                'dateDebut'       => $request->dateDebut,
                'dateFin'         => $request->dateFin,
                'description'     => $request->description,
                'cv_id'           => $request->cv_id,
               
            ]);
         
            
            return response()->json(['message' => 'Formation Academique modifiée avec succès.'], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response()->json(['message' => 'Formation Academique non trouvée.'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $idformationAcademique)
    {
        $formationAcademique = FormationAcademique::findOrFail($idformationAcademique);
        $formationAcademique->delete();
        return response()->json(['message' => ' FormationAcademique Supprimeravec succès.'], 200);
    }
    public function finById( $idformationAcademique)
    {
        $formationAcademique = FormationAcademique::findOrFail($idformationAcademique);
        if($formationAcademique){
            return response()->json(["data"=>$formationAcademique],200);
        }else{
            return response()->json(["message"=>"FormationAcademique Not Found"],404);
        }
    }

    public function getAllFormationsAcdByCVID( $idCv)
    {
        $formationAcademique = FormationAcademique::where('cv_id', $idCv )->get();
        if($formationAcademique){
            return response()->json(["data" => $formationAcademique], 200);
        }else{
            return response()->json(["message"=>"Formation Academique Not Found"],404);
        }

    }
}
