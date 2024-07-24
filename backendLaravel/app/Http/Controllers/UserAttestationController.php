<?php

namespace App\Http\Controllers;

use App\Models\UserAttestation;
use App\Models\User;
use App\Models\Attestation;
use App\Http\Requests\Storeuser_attestationRequest;
use App\Http\Requests\Updateuser_attestationRequest;
use Illuminate\Http\Request;

class UserAttestationController extends Controller
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
    public function store($AttestationID, $UserId)
    {
        $attestation = Attestation::find($AttestationID);
        $user = User::find($UserId);

        if (!$attestation) {
            return response()->json(['error' => 'Attestation not found'], 404);
        }

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $category = $attestation->type;
        $firstName = ucfirst(strtolower($user->prenom));
        $lastName = ucfirst(strtolower($user->nom));
        $name = $firstName . ' ' . $lastName;
        $description = $attestation->description;
        $date = $attestation->created_at->format('Y/m/d');

        switch ($attestation->choix) {
            case 1:
                $imagePath = public_path('images/Bleu beige doré Classique Certificat de concours Diplôme (1).png');
                $fontColorCategory = [134, 108, 6];
                $fontColorName = [8, 84, 102];
                $fontColorDescription = [8, 84, 102];
                $fontColorDate = [8, 84, 102];
                $textPositions = [
                    'category' => [770, 440],
                    'name' => [650, 740],
                    'description' => [910, 915],
                    'date' => [520, 1199],
                ];
                break;
            case 2:
                $imagePath = public_path('images/Gold & Blue Modern Achievement Certificate (1).png');
                $fontColorCategory = [30, 54, 83];
                $fontColorName = [225, 167, 48];
                $fontColorDescription = [30, 54, 83];
                $fontColorDate = [30, 54, 83];
                $textPositions = [
                    'category' => [770, 450],
                    'name' => [650, 740],
                    'description' => [910, 855],
                    'date' => [280, 1240],
                ];
                break;
            case 3:
                $imagePath = public_path('images/Blue Gold Minimalist Certificate Of Appreciation Certificate (1).png');
                $fontColorCategory = [2, 42, 96];
                $fontColorName = [2, 42, 96];
                $fontColorDescription = [2, 42, 96];
                $fontColorDate = [2, 42, 96];
                $textPositions = [
                    'category' => [770, 450],
                    'name' => [650, 740],
                    'description' => [910, 855],
                    'date' => [365, 1120],
                ];
                break;
            case 4:
                $imagePath = public_path('images/Red and Gold Minimal Certificate Template (1).png');
                $fontColorCategory = [0, 0, 0];
                $fontColorName = [148, 0, 0];
                $fontColorDescription = [0, 0, 0];
                $fontColorDate = [0, 0, 0];
                $textPositions = [
                    'category' => [770, 450],
                    'name' => [650, 740],
                    'description' => [910, 855],
                    'date' => [280, 1235],
                ];
                break;
            default:
                return response()->json(['error' => 'Invalid choice'], 400);
        }

        $imageData = file_get_contents($imagePath);

        if ($imageData === false) {
            return response()->json(['error' => 'Error loading image'], 500);
        }

        $image = imagecreatefromstring($imageData);

        if ($image === false) {
            return response()->json(['error' => 'Error creating image'], 500);
        }

        $fontFileInriaSerif = public_path('fonts/InriaSerif-Regular.ttf');
        $fontFileInriaSerifBold = public_path('fonts/InriaSerif-Bold.ttf');
        $fontFilePinyonScript = public_path('fonts/PinyonScript-Regular.ttf');

        $fontSizeCategory = 45;
        $fontSizeName = 95;
        $fontSizeDescription = 24;
        $fontSizeDate = 17;

        $fontColorCategory = imagecolorallocate($image, ...$fontColorCategory);
        $fontColorName = imagecolorallocate($image, ...$fontColorName);
        $fontColorDescription = imagecolorallocate($image, ...$fontColorDescription);
        $fontColorDate = imagecolorallocate($image, ...$fontColorDate);

        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);

        $nameBoundingBox = imagettfbbox($fontSizeName, 0, $fontFilePinyonScript, $name);
        $nameWidth = $nameBoundingBox[4] - $nameBoundingBox[0];
        $textPositions['name'][0] = ($imageWidth - $nameWidth) / 2;

        $categoryBoundingBox = imagettfbbox($fontSizeCategory, 0, $fontFileInriaSerif, $category);
        $categoryWidth = $categoryBoundingBox[4] - $categoryBoundingBox[0];
        $textPositions['category'][0] = ($imageWidth - $categoryWidth) / 2;

        $maxDescriptionWidth = 500;

        $descriptionLines = wordwrap($description, 50, "\n", true);
        $linesArray = explode("\n", $descriptionLines);

        $verticalPosition = 880;

        foreach ($linesArray as $line) {
            do {
                $lineBoundingBox = imagettfbbox($fontSizeDescription, 0, $fontFileInriaSerif, $line);
                $lineWidth = $lineBoundingBox[4] - $lineBoundingBox[0];

                if ($lineWidth > $maxDescriptionWidth) {
                    $cutIndex = mb_strrpos(mb_substr($line, 0, 50), ' ');
                    $cutIndex = $cutIndex === false ? 50 : $cutIndex;

                    $currentLine = mb_substr($line, 0, $cutIndex);
                    $line = mb_substr($line, $cutIndex);

                    $currentLineBoundingBox = imagettfbbox($fontSizeDescription, 0, $fontFileInriaSerif, $currentLine);
                    $currentLineWidth = $currentLineBoundingBox[4] - $currentLineBoundingBox[0];

                    $horizontalPosition = ($imageWidth - $currentLineWidth) / 2;
                    imagettftext($image, $fontSizeDescription, 0, $horizontalPosition, $verticalPosition, $fontColorDescription, $fontFileInriaSerif, $currentLine);

                    $verticalPosition += 30;
                }
            } while ($lineWidth > $maxDescriptionWidth);

            $finalLineBoundingBox = imagettfbbox($fontSizeDescription, 0, $fontFileInriaSerif, $line);
            $finalLineWidth = $finalLineBoundingBox[4] - $finalLineBoundingBox[0];
            $horizontalPosition = ($imageWidth - $finalLineWidth) / 2;

            imagettftext($image, $fontSizeDescription, 0, $horizontalPosition, $verticalPosition, $fontColorDescription, $fontFileInriaSerif, $line);

            $verticalPosition += 30;
        }

        imagettftext($image, $fontSizeCategory, 0, $textPositions['category'][0], $textPositions['category'][1], $fontColorCategory, $fontFileInriaSerifBold, $category);
        imagettftext($image, $fontSizeName, 0, $textPositions['name'][0], $textPositions['name'][1], $fontColorName, $fontFilePinyonScript, $name);
        imagettftext($image, $fontSizeDate, 0, $textPositions['date'][0], $textPositions['date'][1], $fontColorDate, $fontFileInriaSerif, $date);

        $imageName = md5(uniqid('', true)) . '.png';

        $savePath = realpath(base_path('..')) . '/frontlaravel/src/assets/Attestation/AttestationUser/' . $imageName;

        if (!imagepng($image, $savePath)) {
            imagedestroy($image);
            return response()->json(['error' => 'Error saving image'], 500);
        }

        imagedestroy($image);

        $path = 'assets/Attestation/AttestationUser/' . $imageName;

        UserAttestation::create([
            'user_id' => $UserId,
            'attestation_id' => $AttestationID,
            'image' => $path
        ]);


        return response()->json('Attestation user created successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(user_attestation $user_attestation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user_attestation $user_attestation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateuser_attestationRequest $request, user_attestation $user_attestation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user_attestation $user_attestation)
    {
        //
    }


    public function getAttestationByUserId($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $userAttestation = UserAttestation::where('user_id', $userId)->get();

        if ($userAttestation->isEmpty()) {
            return response()->json(['message' => 'Uuser_attestation not found for this user', 'user_id' => $userId], 404);
        }

        $attestation = Attestation::whereIn('id', $userAttestation->pluck('attestation_id'))->get();

        return response()->json($attestation);
    }

}
