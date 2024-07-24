<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\User;
use App\Models\cv;
use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = Formation::all();
        return response()->json(["data" => $formations], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormationRequest $request)
    {
        Formation::create([
            'titre'         => $request->titre,
            'description'   => $request->description,
            'categorie'     => $request->categorie,
            'date'          => $request->date,
            'type_formation' => $request->type_formation,
            'organisation'  => $request->organisation,
            'cv_id'         => $request->cv_id,

        ]);

        return response()->json(['message' => 'Formation  Ajouter avec succès.'], 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(Formation $formation)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation)
    {
        //
    }





    /**
     * Update the specified resource in storage.
     */ public function update(UpdateFormationRequest $request, $id)
    {
        try {
            $formation = Formation::findOrFail($id);
            $formation->update([

                'titre'         => $request->titre,
                'description'   => $request->description,
                'categorie'     => $request->categorie,
                'date'          => $request->date,
                'type_formation' => $request->type_formation,
                'organisation'  => $request->organisation,
                'cv_id'         => $request->cv_id,

            ]);


            return response()->json(['message' => 'Formation  modifiée avec succès.'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response()->json(['message' => 'Formation  non trouvée.'], 404);
        }
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idFormation)
    {
        $formation = Formation::findOrFail($idFormation);
        $formation->delete();
        return response()->json(['message' => ' Formation Supprimeravec succès.'], 200);
    }
    public function count(Formation $formation)
    {
        $count = Formation::count();
        return response()->json(['count' => $count]);
    }




    public function getFormations4cByUserId($userId)
    {

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $CVs = CV::where('user_id', $userId)->get();


        if ($CVs->isEmpty()) {
            return response()->json(['message' => 'CV not found for this user', 'user_id' => $userId], 404);
        }

        $allFormations = collect();

        foreach ($CVs as $CV) {
            $formations = Formation::where('cv_id', $CV->id)
                                   ->where('type_formation', 'formation4C')
                                   ->get();
            $allFormations = $allFormations->merge($formations);
        }

        return response()->json($allFormations, 200);
    }

    public function getAllformationExterne($idCV)
    {
        $formationsExternes = Formation::where('cv_id', $idCV)->where('type_formation', 'formationExterne')->get();
        if ($formationsExternes) {
            return response()->json(["data" => $formationsExternes], 200);
        } else {
            return response()->json(["message" => "Formations Externes Not Found"], 404);
        }
    }

}
