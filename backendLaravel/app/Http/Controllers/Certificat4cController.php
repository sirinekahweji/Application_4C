<?php

namespace App\Http\Controllers;

use App\Mail\NouvelleCertification;
use App\Models\certificat4c;
use App\Http\Requests\Storecertificat4cRequest;
use App\Http\Requests\Updatecertificat4cRequest;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Certificat4cController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificats = certificat4c::orderBy('id', 'desc')->get();
        return response()->json(["data" => $certificats], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imageData = $request->certificat;

        // Extract the mime type and the base64 data from the image data
        list($type, $imageData) = explode(';', $imageData);
        list(, $imageData) = explode(',', $imageData);

        // Decode the base64 image data
        $imageData = base64_decode($imageData);

        // Generate a unique image name
        $imageName = md5(uniqid('', true)) . '.png';

        // Specify the path to the assets directory
        $path = realpath(base_path('..')) . '/frontlaravel/src/assets/Certificat4c/' . $imageName;

        if (file_put_contents($path, $imageData)) {
            $path = 'assets/Certificat4c/' . $imageName;

            $certif = certificat4c::create([
                "nom" => $request->nom,
                "lieu" => $request->lieu,
                "affiche" => $request->affiche,
                "capacite" => $request->capacite,
                "dateLimiteInscription" => $request->dateLimiteInscription,
                "date" => $request->date,
                "certificat" => $path,
                "code_qr" => "",
                "prix" => $request->prix,
                "offre" => $request->offre,
                "organisation" => $request->organisation,
                "categorie" => $request->categorie,
                "forManagers" => $request->forManagers,
                "description" => $request->description,
            ]);

            $url = "http://localhost:8081/Certificat/Detail/" . $certif->id;

            $qrCode = QrCode::size(120)->generate($url);

            $certif->update([
                "code_qr" => $qrCode,
            ]);
            // Mail::to('mouradsoltan890@gmail.com')->send(new NouvelleCertification($certif));
        }

        return response()->json($certif, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(certificat4c $certificat4c)
    {
        return response()->json($certificat4c);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $certificat = certificat4c::findOrFail($id);
        return response()->json($certificat, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $certificat4c = certificat4c::findOrFail($id);
        $certificat4c->update($request->all());
        return response()->json(["message" => "Certificat mis à jour avec succès"], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $certificat4c = certificat4c::findOrFail($id);
        $certificat4c->delete();
        return response()->json(["message" => "Certificat supprimé avec succès"], 204);
    }

    public function count(certificat4c $certificat)
    {
        $count = certificat4c::count();
        return response()->json(['count' => $count]);
    }

    public function getCertificat4cDisponible()
    {
        $dateActuelle = Carbon::now();

        $certificatsDisponibles = Certificat4C::where('date', '>=', $dateActuelle)->orderBy('id', 'desc')->get();

        return response()->json($certificatsDisponibles, 200);
    }

    public function getCertificat4cNonDisponible()
    {
        $dateActuelle = Carbon::now();

        $certificatsNonDisponibles = Certificat4C::where('date', '<', $dateActuelle)->orderBy('id', 'desc')->get();

        return response()->json($certificatsNonDisponibles, 200);
    }
}
