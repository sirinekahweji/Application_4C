<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use App\Models\UserAttestation;
use App\Models\UserBadge;

class UserController extends Controller
{

    public function updateCredentials(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
        }

        $user->email = $request->email ?? $user->email;
        $user->password = Hash::make($request->password) ?? $user->password;

        $user->save();

        return response()->json(['message' => 'Email et mot de passe mis à jour avec succès.'], 200);
    }



    public function getUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        return $user;
    }

    public function checkPassword(Request $request, $id)
    {
        $user = $this->getUser($id);
        if (!Hash::check($request->input('password'), $user->password)) {
            return response()->json(['message' => 'Invalid password.'], 422);
        }
        return response()->json(['message' => 'Password is correct.']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('corbeille', 0)->get();
        return response()->json(["data" => $users], 200);
    }

    public function indexHistorique()
    {
        $users = User::where('corbeille', 1)->get();
        return response()->json(["data" => $users], 200);
    }

    public function indexEtudiant()
    {
        $users = User::where('user_type', 'Etudiant')->get();
        return response()->json(["data" => $users], 200);
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
    public function store(StoreUserRequest $request)
    {
        $roleController = new RoleController();
        $idParticipant = $roleController->findIdParticipant();

        $userData = [
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "phoneNumber" => $request->phoneNumber,
            "cin" => $request->cin,
            "genre" => $request->genre,
            "adresse" => $request->adresse,
            "Gouvernorat" => $request->Gouvernorat,
            "user_type" => $request->user_type,
            "corbeille" => 0,
            "email" => $request->email,
        ];

        $qrCode = QrCode::size(120)->generate(json_encode([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            "genre" => $request->genre,
            "user_type" => $request->user_type,
        ]));

        $user = User::create([
            "nom" => $userData['nom'],
            "prenom" => $userData['prenom'],
            "phoneNumber" => $userData['phoneNumber'],
            "cin" => $userData['cin'],
            "code_qr" => $qrCode,
            "photoProfile" => null,
            "photoCouverture" => null,
            "genre" => $userData['genre'],
            "dateNaissance" => $request->dateNaissance,
            "lienLinkdIn" => null,
            "nbEtoiles" => 0,
            "adresse" => $userData['adresse'],
            "Gouvernorat" => $userData['Gouvernorat'],
            "user_type" => $userData['user_type'],
            "corbeille" => 0,
            "role_id" => $idParticipant,
            "email" => $request->email,
            "password" => bcrypt($request->password),

        ]);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request,  $id)
    {
        $User = User::find($id);
        if (!$User) {
            return response()->json(["message" => "User Not Found"], 404);
        }

        $User->nom = $request->nom;
        $User->prenom = $request->prenom;
        $User->dateNaissance = $request->dateNaissance;
        $User->cin = $request->cin;
        $User->genre = $request->genre;
        $User->phoneNumber = $request->phoneNumber;
        $User->adresse = $request->adresse;
        $User->Gouvernorat = $request->Gouvernorat;
        $User->lienLinkdIn = $request->lienLinkdIn;
        $User->photoProfile = $request->photoProfile;
        $User->photoCouverture = $request->photoCouverture;

        $User->save();
        return response()->json(["message" => "User Updated"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idUser)
    {
        $user = User::findOrFail($idUser);
        $user->corbeille = true;
        $user->save();

        return response()->json(['message' => 'Utilisateur mis dans la corbeille avec succès.'], 200);
    }

    function countManagers()
    {
        $count = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.nomRole', '=', 'manager')
            ->count();

        return response()->json(['count' => $count]);
    }

    public function findById($idUser)
    {
        $User = User::findOrFail($idUser);
        if ($User) {
            return response()->json(["data" => $User], 200);
        } else {
            return response()->json(["message" => "User Not Found"], 404);
        }
    }

    public function finById($idUser)
    {
        $User = User::findOrFail($idUser);
        if ($User) {
            return response()->json(["data" => $User], 200);
        } else {
            return response()->json(["message" => "User Not Found"], 404);
        }
    }

    public function managers($id)
    {
        $nomRole = 'manager';
        $role = Role::where('nomRole', $nomRole)->first();

        if ($role) {
            $role_id = $role->id;
            $acces = 1;
            $managers = User::where('role_id', $role_id)
                ->whereNotIn('id', [$id])
                ->get();

            if ($managers->isEmpty()) {
                return response()->json(["message" => "Aucun 'manager' trouvé"], 404);
            } else {
                return response()->json($managers);
            }
        } else {
            return response()->json(["message" => "Aucun 'manager' trouvé"], 404);
        }
    }

    public function uploadPhotoProfil(Request $request, $idUser)
    {  
        $user = User::find($idUser);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        
        if ($request->hasFile('photo_profile')) {
            $imageData = $request->file('photo_profile');
    
            $userName = $user->nom . '_' . $user->prenom . '_' . $user->cin;
    
            // Obtenir l'extension de l'image
            $extension = $imageData->getClientOriginalExtension();
    
            // Nom de fichier unique en combinant nom, prénom et CIN de l'utilisateur
            $fileName = $userName . '.' . $extension;
    
            // Specify the path to the assets directory
            $path = realpath(base_path('..')) . '/frontlaravel/src/assets/PhotosProfils/' . $fileName;
      // Supprimer l'ancienne photo de profil si elle existe
      if ($user->photoProfile) {
        $oldPhotoPath = realpath(base_path('..')) . '/frontlaravel/src/assets/PhotosProfils/' . $user->photoProfile;
        if (file_exists($oldPhotoPath)) {
            unlink($oldPhotoPath);
        }
    }
            // Save the image to the specified path
            if (file_put_contents($path, file_get_contents($imageData))) {
                $user->photoProfile = $fileName;
                $user->save();
                return response()->json(['message' => 'Success'], 200);
            } else {
                return response()->json(['message' => 'Failed to save image.'], 500);
            }
        } else {
            return response()->json(['message' => 'No file uploaded.'], 400);
        }
    }

    public function uploadPhotoCouverture(Request $request, $idUser)
    {  
        $user = User::find($idUser);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        
        if ($request->hasFile('photo_couverture')) {
            $imageData = $request->file('photo_couverture');
    
            $userName = $user->nom . '_'. $user->cin;
    
            // Obtenir l'extension de l'image
            $extension = $imageData->getClientOriginalExtension();
    
            // Nom de fichier unique en combinant nom, prénom et CIN de l'utilisateur
            $fileName = $userName . '.' . $extension;
    
            // Specify the path to the assets directory
            $path = realpath(base_path('..')) . '/frontlaravel/src/assets/PhotosCouvertures/' . $fileName;
           // Supprimer l'ancienne photo de couverture si elle existe
           if ($user->photoCouverture) {
             $oldPhotoPath = realpath(base_path('..')) . '/frontlaravel/src/assets/PhotosCouvertures/' . $user->photoCouverture;
             if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
              }
            }
            // Save the image to the specified path
            if (file_put_contents($path, file_get_contents($imageData))) {
                $user->photoCouverture = $fileName;
                $user->save();
                //return response()->json(['message' => 'Success'], 200);
                return $user;

            } else {
                return response()->json(['message' => 'Failed to save image.'], 500);
            }
        } else {
            return response()->json(['message' => 'No file uploaded.'], 400);
        }
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'No user found with this email address.'], 404);
        }

        $newPassword = Str::random(8);

        $user->password = bcrypt($newPassword);
        $user->save();

        Mail::to($user->email)->send(new ResetPasswordMail($newPassword));

        return response()->json(['message' => 'Nouveau mot de passe envoyé par e-mail'], 200);
    }

    public function acceptAccess(Request $request, $id)
    {
        $validatedData = $request->validate([
            'role_name' => 'required|string',
        ]);

        $role = Role::where('nomRole', $validatedData['role_name'])->first();

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->role_id = $role->id;
        $user->save();

        return response()->json([
            'message' => 'User access accepted and role updated',
            'user' => $user
        ], 200);
    }

    public function getUsersWithoutAttestation($idAttestation)
    {
        $attestationsUser = UserAttestation::where('attestation_id', $idAttestation)->get();

        $userIds = $attestationsUser->pluck('user_id')->toArray();

        $users = User::whereNotIn('id', $userIds)->get();

        return response()->json($users);
    }


    public function getUsersWithAttestation($idAttestation)
    {
        $attestationsUser = UserAttestation::where('attestation_id', $idAttestation)->get();

        $userIds = $attestationsUser->pluck('user_id')->toArray();

        $users = User::whereIn('id', $userIds)->get();

        return response()->json($users);
    }

    public function getUsersWithoutBadge($idBadge)
    {
        $BadgesUser = UserBadge::where('badge_id', $idBadge)->get();

        $userIds = $BadgesUser->pluck('user_id')->toArray();

        $users = User::whereNotIn('id', $userIds)->get();

        return response()->json($users);
    }


    public function getUsersWithBadge($idBadge)
    {
        $BadgesUser = UserBadge::where('badge_id', $idBadge)->get();

        $userIds = $BadgesUser->pluck('user_id')->toArray();

        $users = User::whereIn('id', $userIds)->get();

        return response()->json($users);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'tempPassword' => 'required',
            'newPassword' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }

        if (!Hash::check($request->tempPassword, $user->password)) {
            return response()->json(['message' => 'Le mot de passe temporaire est incorrect'], 401);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json(['message' => 'Le mot de passe a été réinitialisé avec succès']);
    }

    public function evaluer(Request $request, $id)
    {
        $validatedData = $request->validate([
            'etoiles' => 'required',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->nbEtoiles = $validatedData['etoiles'];
        $user->save();

        return response()->json([
            'message' => 'User evaluted',
            'user' => $user
        ], 200);
    }
}
