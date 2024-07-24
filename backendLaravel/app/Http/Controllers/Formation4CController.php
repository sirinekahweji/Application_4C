<?php

namespace App\Http\Controllers;

use App\Models\Formation4C;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class Formation4CController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = Formation4C::orderBy('id', 'desc')->get();
        return response()->json(["data" => $formations], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imageData = $request->affiche;

        // Extract the mime type and the base64 data from the image data
        list($type, $imageData) = explode(';', $imageData);
        list(, $imageData) = explode(',', $imageData);

        // Decode the base64 image data
        $imageData = base64_decode($imageData);

        // Generate a unique image name
        $imageName = md5(uniqid('', true)) . '.png';

        // Specify the path to the assets directory
        $path = realpath(base_path('..')) . '/frontlaravel/src/assets/Formation4c/' . $imageName;

        if (file_put_contents($path, $imageData)) {
            $path = 'assets/Formation4c/' . $imageName;

            $formation = Formation4C::create([
                "nbSession" => $request->nbSession,
                "formateur" => $request->formateur,
                "affiche" => $path,
                "capacite" => $request->capacite,
                "code_qr" => "",
                "dateLimiteInscription" => $request->dateLimiteInscription,
                "titre" => $request->titre,
                "categorie" => $request->categorie,
                "forManagers" => $request->forManagers,
            ]);

            $url = "http://localhost:8081/Formation/Detail/" . $formation->id;

            $qrCode = QrCode::size(120)->generate($url);

            $formation->update([
                "code_qr" => $qrCode,
            ]);
        }

        return response()->json($formation, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Formation4C $formation)
    {
        return response()->json($formation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $formation = Formation4C::findOrFail($id);
        return response()->json($formation, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $formation = Formation4C::findOrFail($id);
        $formation->update($request->all());
        return response()->json(["message" => "Formation mise à jour avec succès"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $formation = Formation4C::findOrFail($id);
        $formation->delete();
        return response()->json(["message" => "Formation supprimée avec succès"], 204);
    }

    public function count()
    {
        $count = Formation4C::count();
        return response()->json(['count' => $count]);
    }

    public function getFormationDisponible()
    {
        $dateActuelle = Carbon::now();

        $formationsDisponibles = Formation4C::where('dateLimiteInscription', '>=', $dateActuelle)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($formationsDisponibles, 200);
    }

    public function getFormationNonDisponible()
    {
        $dateActuelle = Carbon::now();

        $formationsNonDisponibles = Formation4C::where('dateLimiteInscription', '<', $dateActuelle)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($formationsNonDisponibles, 200);
    }
}
