<?php

namespace App\Http\Controllers;

use App\Models\UserBadge;
use App\Models\Badge;
use App\Models\User;
use App\Http\Requests\Storeuser_badgeRequest;
use App\Http\Requests\Updateuser_badgeRequest;

class UserBadgeController extends Controller
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
    public function store($BadgeId, $UserId)
    {
        $badge = Badge::find($BadgeId);
        $user = User::find($UserId);

        if (!$badge) {
            return response()->json(['error' => 'Badge not found'], 404);
        }

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $type = $badge->type;
        $firstName = ucfirst(strtolower($user->prenom));
        $lastName = ucfirst(strtolower($user->nom));
        $name = $firstName . ' ' . $lastName;

        switch ($badge->choix) {
            case 1:
                $imagePath = public_path('images/1.png');
                $fontColor = [255, 255, 255];
                break;
            case 2:
                $imagePath = public_path('images/2.png');
                $fontColor = [0, 0, 0];
                break;
            case 3:
                $imagePath = public_path('images/3.png');
                $fontColor = [0, 0, 0];
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

        $fontFileInriaSerifBold = public_path('fonts/InriaSerif-Bold.ttf');
        $fontFilePinyonScript = public_path('fonts/PinyonScript-Regular.ttf');

        $fontSizeType = 110;
        $fontSizeName = 65;

        $fontColorType = imagecolorallocate($image, ...$fontColor);
        $fontColorName = imagecolorallocate($image, ...$fontColor);

        $imageWidth = imagesx($image);

        $typeBoundingBox = imagettfbbox($fontSizeType, 0, $fontFileInriaSerifBold, $type);
        $typeWidth = $typeBoundingBox[4] - $typeBoundingBox[0];
        $typeX = ($imageWidth - $typeWidth) / 2;
        $typeY = 600;

        $nameBoundingBox = imagettfbbox($fontSizeName, 0, $fontFilePinyonScript, $name);
        $nameWidth = $nameBoundingBox[4] - $nameBoundingBox[0];
        $nameX = ($imageWidth - $nameWidth) / 2;
        $nameY = 800;

        imagettftext($image, $fontSizeType, 0, $typeX, $typeY, $fontColorType, $fontFileInriaSerifBold, $type);
        imagettftext($image, $fontSizeName, 0, $nameX, $nameY, $fontColorName, $fontFilePinyonScript, $name);

        $imageName = md5(uniqid('', true)) . '.png';

        $savePath = realpath(base_path('..')) . '/frontlaravel/src/assets/Badge/BadgeUser/' . $imageName;

        if (!imagepng($image, $savePath)) {
            imagedestroy($image);
            return response()->json(['error' => 'Error saving image'], 500);
        }

        imagedestroy($image);

        $path = 'assets/Badge/BadgeUser/' . $imageName;

        UserBadge::create([
            'user_id' => $UserId,
            'badge_id' => $BadgeId,
            'image' => $path
        ]);

        return response()->json('Badge user created successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(user_badge $user_badge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user_badge $user_badge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateuser_badgeRequest $request, user_badge $user_badge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user_badge $user_badge)
    {
        //
    }
    public function getBadgeByUserId($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $userBadges = UserBadge::where('user_id', $userId)->get();

        if ($userBadges->isEmpty()) {
            return response()->json(['message' => 'User badges not found for this user', 'user_id' => $userId]);
        }

        $badges = Badge::whereIn('id', $userBadges->pluck('badge_id'))->get();

        return response()->json($badges);
    }

    public function getLastSixBadges()
    {
        $badges = UserBadge::orderBy('id', 'desc')->take(6)->get();

        return response()->json($badges);
    }
}
