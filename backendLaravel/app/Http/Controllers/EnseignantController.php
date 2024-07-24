<?php

namespace App\Http\Controllers;

use App\Models\Certificat;
use App\Models\Enseignant;
use App\Http\Requests\StoreEnseignantRequest;
use App\Http\Requests\UpdateEnseignantRequest;
use App\Http\Controllers\UserController;
use App\Http\Requests\UpdateUserRequest;



class EnseignantController extends Controller
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
    public function store(StoreEnseignantRequest $request)
    {
        Enseignant::create([
            "etablissement"=>$request->etablissement,
            "departement_id"=>$request->departement_id,
            "user_id"=>$request->user_id,
        ]);

        return response()->json(["message"=>"enseignant Created"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enseignant $enseignant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enseignant $enseignant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnseignantRequest $request,  $id)
    {
        $enseignant = Enseignant::find($id);
        if (!$enseignant) {
            return response()->json(["message" => "Enseignant Not Found"], 404);
        }
    
        $enseignant->etablissement = $request->etablissement;
        $enseignant->departement_id = $request->departement_id;
        $enseignant->save();
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
        $userController->update($userRequest, $enseignant->user_id);
        return response()->json(["message" => "enseignant Updated"], 200);
    }
        
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enseignant $enseignant)
    {
        //
    }

    public function count(Enseignant $enseignant){
        $count = Enseignant::count();
        return response()->json(['count' => $count]);
    }
    public function findByUserId( $idUser)
    {
        $enseignant = Enseignant::where('user_id', $idUser )->first();
        if($enseignant){
            return response()->json(["data"=>$enseignant],200);
        }else{
            return response()->json(["message"=>"Enseignant  Not Found"],404);
        }
    }
}
