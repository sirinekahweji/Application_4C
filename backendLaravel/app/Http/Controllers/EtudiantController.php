<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateSpecialiteRequest;
use App\Http\Requests\UpdateClasseRequest;




class EtudiantController extends Controller
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
    public function store(StoreEtudiantRequest $request)
    {
        Etudiant::create([
            "etablissement"=>$request->etablissement,
            "classe_id"=>$request->classe_id,
            "user_id"=>$request->user_id,
        ]);

        return response()->json(["message"=>"etudiant Created"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,UpdateEtudiantRequest $request)
    {
        //return response()->json(["message" => $request], 200);

        $Etudiant = Etudiant::find($id);
        if (!$Etudiant) {
            return response()->json(["message" => "Etudiant  Not Found"], 404);
        }
        $Etudiant->etablissement = $request->etablissement;
        $Etudiant->classe_id = $request->classe_id;


        $Etudiant->save();
        $userRequest = new UpdateUserRequest([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'dateNaissance' => $request->dateNaissance,
            'cin' => $request->cin,
            'genre' => $request->genre,
            'phoneNumber' => $request->phoneNumber,
            'adresse' => $request->adresse,
            'Gouvernorat' => $request->Gouvernorat,
            'lienLinkdIn' => $request->lienLinkdIn,
            'photoProfile' => $request->photoProfile,
            'photoCouverture' => $request->photoCouverture,
        ]);
        $userController = new UserController();
        $userController->update($userRequest, $Etudiant->user_id);

/*
        $classeRequest = new UpdateClasseRequest([  
            "nom"=>$request->nomClasse,
            "abreviation"=>$request->abreviationClasse,
            "specialite_id"=>$request->specialite_id
        ]);

        $classeController = new ClasseController();
        $classeController->update($classeRequest, $Etudiant->classe_id);

        $specialiteRequest = new UpdateSpecialiteRequest([  
            "nom"=>$request->nomSpecialite,
            "abreviation"=>$request->abreviationSpecialite,
            "departement_id"=>$request->departement_id
        ]);

        $SpecialiteController = new SpecialiteController();
        $SpecialiteController->update($specialiteRequest, $request->specialite_id);
*/

        $Etudiant->save();
        return response()->json(["message" => "Etudiant  Updated"], 200);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        //
    }

    public function count(Etudiant $etudiant){
        $count = Etudiant::count();
        return response()->json(['count' => $count]);
    }

    public function findByUserId( $idUser)
    {
        $Etudiant = Etudiant::where('user_id', $idUser )->first();
        if($Etudiant){
            return response()->json(["data"=>$Etudiant],200);
        }else{
            return response()->json(["message"=>"Etudiant  Not Found"],404);
        }
    }

}
