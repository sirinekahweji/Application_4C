<?php

namespace App\Http\Controllers;

use App\Models\PersonnelEntreprise;
use App\Http\Requests\StorePersonnelEntrepriseRequest;
use App\Http\Requests\UpdatePersonnelEntrepriseRequest;
use App\Http\Requests\UpdateUserRequest;

use App\Models\User;

class PersonnelEntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personnels = PersonnelEntreprise::whereHas('user', function ($query) {
            $query->where('corbeille', 0);
        })->get();
    
        return response()->json(["data" => $personnels], 200);
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
    public function store(StorePersonnelEntrepriseRequest $request)
    {
        PersonnelEntreprise::create([
            "fonctionnalite"=>$request->fonctionnalite,
            "entreprise_id"=>$request->entreprise_id,
            "user_id"=>$request->user_id,
        ]);

        return response()->json(["message"=>"personnel Created"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonnelEntreprise $personnelEntreprise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PersonnelEntreprise $personnelEntreprise)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonnelEntrepriseRequest $request,  $id)
    {
        $PersonnelEntreprise = PersonnelEntreprise::find($id);
        if (!$PersonnelEntreprise) {
            return response()->json(["message" => "Personnel Entreprise Not Found"], 404);
        }
    
        $PersonnelEntreprise->fonctionnalite = $request->fonctionnalite;
        $PersonnelEntreprise->entreprise_id = $request->entreprise_id;


        $PersonnelEntreprise->save();
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
        $userController->update($userRequest, $PersonnelEntreprise->user_id);
        return response()->json(["message" => "Personnel Entreprise Updated"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $personnel = PersonnelEntreprise::findOrFail($id);

        if ($personnel) {
            $user = User::findOrFail($personnel->user_id);
            $user->corbeille = true;
            $user->save();
            return response()->json(['message' => 'Personnel mis dans la corbeille avec succès.'], 200);
        } else {
            return response()->json(['error' => 'Personnel non trouvé.'], 404);
        }
    }

    public function findByUserId( $idUser)
    {
        $PersonnelEntreprise = PersonnelEntreprise::where('user_id', $idUser )->first();
        if($PersonnelEntreprise){
            return response()->json(["data"=>$PersonnelEntreprise],200);
        }else{
            return response()->json(["message"=>"PersonnelEntreprise  Not Found"],404);
        }
    }
/* public function findByUserId($idUser)
{
    $personnelEntreprise = PersonnelEntreprise::where('user_id', $idUser)->first();

    if ($personnelEntreprise) {
        $entreprise = $personnelEntreprise->entreprise;

        if ($entreprise) {
            return response()->json([
                "personnel_entreprise" => $personnelEntreprise,
                "entreprise" => $entreprise
            ], 200);
        } else {
            return response()->json(["message" => "Entreprise Not Found for PersonnelEntreprise"], 404);
        }
    } else {
        return response()->json(["message" => "PersonnelEntreprise Not Found"], 404);
    }
}*/

}
