<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Http\Requests\StoreEntrepriseRequest;
use App\Http\Requests\UpdateEntrepriseRequest;
use App\Models\PersonnelEntreprise;
use App\Models\User;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entreprises = Entreprise::where('corbeille', 0)->get();
        return response()->json(["data"=>$entreprises],200);
    }

    public function indexHistorique()
    {
        $entreprises = Entreprise::where('corbeille', 1)->get();
        return response()->json(["data"=>$entreprises],200);
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
    public function store(StoreEntrepriseRequest $request)
    {
        Entreprise::create([
            "nom"=>$request->nom,
            "secteurActivite"=>$request->secteurActivite,
            "adresse"=>$request->adresse,
            "phone"=>$request->phone,
        ]);

        return response()->json(["message"=>"Company Created"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Entreprise $entreprise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entreprise $entreprise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntrepriseRequest $request, $id)
    {
        $entrep = Entreprise::findOrFail($id);

        $entrep->update([
            'nom' => $request->nom,
            'secteurActivite' => $request->secteurActivite,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
        ]);

        return response()->json(['message' => 'entreprise mis à jour avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->corbeille = true;
        $entreprise->save();
        $personnels = PersonnelEntreprise::where('entreprise_id', $entreprise->id)->get();
        foreach ($personnels as $personnel) {
            $user = User::findOrFail($personnel->user_id);
            $user->corbeille = true;
            $user->save();
        }

        return response()->json(['message' => 'Entreprise et utilisateurs associés mis dans la corbeille avec succès.'], 200);
    }

    public function count(Entreprise $entreprise){
        $count = Entreprise::count();
        return response()->json(['count' => $count]);
    }

    public function findById( $id)
    {
        $entreprise = Entreprise::findOrFail($id);
        if($entreprise){
            return response()->json(["data"=>$entreprise],200);
        }else{
            return response()->json(["message"=>"Entreprise Not Found"],404);
        }
    }
}
