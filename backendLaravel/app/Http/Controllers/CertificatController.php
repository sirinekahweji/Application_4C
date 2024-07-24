<?php

namespace App\Http\Controllers;

use App\Models\cv;
use App\Models\User;
use App\Models\Certificat;
use App\Http\Requests\StoreCertificatRequest;
use App\Http\Requests\UpdateCertificatRequest;

class CertificatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       /* $certificats = Certificat::all();
        return  response()->json(["data"=>$certificats], 200);
       */
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
////////////////////////////////////////////
    /**g
     * Store a newly created resource in storage.
     */
   public function store(StoreCertificatRequest $request)
    {
       Certificat::create([
        "titre"=>$request->titre,
        "description"=>$request->description,
        "categorie"=>$request->categorie,
        "type_certificat"=>$request->type_certificat,
        "date"=>$request->date,
        "organisation"=>$request->organisation,
        "certificat"=>$request->certificat,
        "cv_id"=>$request->cv_id,

       ]);

       return response()->json(["message"=>"Certificat Ajouter Avec succès"],201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Certificat $certificat)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificat $certificat)
    {
        //
    }
    public function getCertificatsByUserId($userId)
    {
        
        $user = User::find($userId);
    
        if (!$user) {
            return response()->json(['message' => 'user Profile not found'], 404);
        }

        $CV = cv::where('user_id', $userId)->first();
    
        if (!$CV) {
            return response()->json(['message' => 'CV not found for this user', 'user_id' => $userId], 404);
        }
    
        $certificats = Certificat::where('cv_id', $CV->id)
                               ->where('type_certificat', '4c')
                               ->get();
    
        return response()->json($certificats);
    }

    /**
     * Update the specified resource in storage.
     */

public function update(UpdateCertificatRequest $request, $id)
    {

        $certificat = Certificat::find($id);
        if (!$certificat) {
            return response()->json(["message" => "Certificat Not Found"], 404);
        }
    
        $certificat->titre = $request->titre;
        $certificat->description = $request->description;
        $certificat->categorie = $request->categorie;
        $certificat->date = $request->date;
        $certificat->type_certificat = $request->type_certificat;
        $certificat->organisation = $request->organisation;
        $certificat->certificat = $request->certificat;
        $certificat->cv_id = $request->cv_id;
        
        $certificat->save();
    
        return response()->json(["message" => "Certificat Updated"], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $certificat = Certificat::find($id);
        if ($certificat) {
            $certificat->delete();
            return response()->json(["message" => "Certificat Deleted With Success"], 200);
        } else {
            return response()->json(["message" => "Certificat Not Found"], 404);
        }
    }


    public function count(Certificat $certificat){
        $count = Certificat::count();
        return response()->json(['count' => $count]);
    
    }
    ///////////////////////////////////////////////
   /* public function findById($id)
    {
        $certificat = Certificat::find($id);
        if($certificat){
            return response()->json(["data"=>$certificat],200);
        }else{
            return response()->json(["message"=>"Certificat Not Found"],404);
        }
    }
*/
//////////////////////////////////////////////////
//participer aux certificat:::::
/*public function participer(Request $request, Certificat $certificat)
{
    // Vérifier l'authentification de l'utilisateur
    if (!auth()->check()) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Vérifier la disponibilité du certificat
    if ($certificat->participants->count() >= $certificat->capacite) {
        return response()->json(['message' => 'Le certificat est complet'], 400);
    }

    // Associer l'utilisateur au certificat
    $user = auth()->user();
    $certificat->participants()->attach($user->id);

    // Mettre à jour l'état du certificat
    if ($certificat->participants->count() >= $certificat->capacite) {
        $certificat->etat = 'Complet'; // Mettre à jour l'état du certificat à "Complet"
        $certificat->save();
    }

    // Retourner une réponse de confirmation
    return response()->json(['message' => 'Vous avez participé au certificat avec succès'], 200);
}
*/

public function getCertifsExternesByIdCV( $idCV)
    {
        $certificats= Certificat::where('cv_id', $idCV )->where('type_certificat','Externe')->get();
        if($certificats){
            return response()->json(["data" => $certificats], 200);
        }else{
            return response()->json(["message"=>"certificats Externes Not Found"],404);
        }

    }
}
