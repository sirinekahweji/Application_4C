<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Http\Requests\StoreEvenementRequest;
use App\Http\Requests\UpdateEvenementRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;


class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Evenement::orderBy('id', 'desc')->get();
        return response()->json(["data" => $events], 200);
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
    public function store(Request $request)
    {
        // Extract the base64 image data from the request
        $imageData = $request->affiche;

        // Extract the mime type and the base64 data from the image data
        list($type, $imageData) = explode(';', $imageData);
        list(, $imageData) = explode(',', $imageData);

        // Decode the base64 image data
        $imageData = base64_decode($imageData);

        // Generate a unique image name
        $imageName = md5(uniqid('', true)) . '.png';

        // Specify the path to save the uploaded image
        $path = realpath(base_path('..')) . '/frontlaravel/src/assets/Evenements/' . $imageName;

        // Save the decoded image data to the specified path
        if (file_put_contents($path, $imageData)) {
            $path = 'assets/Evenements/' . $imageName;

            // Create a new Evenement model instance
            $evenement = Evenement::create([
                "affiche" => $path,
                "capacite"  => $request->capacite,
                "dateLimiteInscription" => $request->dateLimiteInscription,
                "forManagers"  => $request->forManagers,
                "categorie"    => $request->categorie,
                "lieu"      => $request->lieu,
                "description"   => $request->description,
                "titre"        => $request->titre,
                "date"        => $request->date,
                "organisateur" => $request->organisateur,
                "code_qr" => "",
            ]);

            $url = "http://localhost:8081/Evenement/Detail/" . $evenement->id;

            $qrCode = QrCode::size(120)->generate($url);

            // Update the evenement record with the generated QR code
            $evenement->update([
                "code_qr" => $qrCode,
            ]);

            // Return a JSON response with the created evenement data
            return response()->json($evenement, 201);
        }

        // Return an error response if the image upload fails
        return response()->json(["message" => "Failed to upload image"], 500);
    }


    /**
     * Display the specified resource.
     */
    public function show(Evenement $evenement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $evenement = Evenement::findOrFail($id);
        return response()->json($evenement, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->update($request->all());
        return response()->json(["message" => "Evenement mis à jour avec succès"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->delete();
        return response()->json(["message" => "Evenement supprimé avec succès"], 204);
    }

    public function count(Evenement $evenement)
    {
        $count = Evenement::count();
        return response()->json(['count' => $count]);
    }

    public function getEvenementDisponible()
    {
        $dateActuelle = Carbon::now();

        $evenementsDisponibles = Evenement::where('dateLimiteInscription', '>=', $dateActuelle)->orderBy('id', 'desc')->get();

        return response()->json($evenementsDisponibles, 200);
    }

    public function getEvenementNonDisponible()
    {
        $dateActuelle = Carbon::now();

        $evenementsNonDisponibles = Evenement::where('dateLimiteInscription', '<', $dateActuelle)->orderBy('id', 'desc')->get();

        return response()->json($evenementsNonDisponibles, 200);
    }
}
