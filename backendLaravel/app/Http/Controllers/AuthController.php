<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function Login(AuthRequest $request)  {

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])
                    ->where('corbeille', 0)
                    ->first();

        if (!$user) {
            return response()->json(["message" => "User Not Found"], 404);
        }

        if (Auth::attempt($credentials)) {
            $token = $user->createToken('api_token')->plainTextToken;
            return response()->json([
                "user" => $user,
                "token" => $token
            ], 200);
        } else {
            return response()->json(["message" => "Unauthorized"], 401);
        }
    }

}
