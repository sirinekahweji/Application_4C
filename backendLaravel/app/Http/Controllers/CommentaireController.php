<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Http\Requests\StoreCommentaireRequest;
use App\Http\Requests\UpdateCommentaireRequest;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($publication_id)
    {
        $commentaires = Commentaire::where('publication_id', $publication_id)->get();
        return response()->json($commentaires);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'publication_id' => 'required|exists:publications,id',
            'user_id' => 'required|exists:users,id'
        ]);

        Commentaire::create([
            'description' => $request->description,
            'publication_id' => $request->publication_id,
            'user_id' => $request->user_id
        ]);

        return response()->json(['message' => 'Commentaire créé avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Commentaire $commentaire)
    {
        // Retourner le commentaire spécifié
        return response()->json($commentaire);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $commentaire = Commentaire::findOrFail($id);

        $commentaire->update([
            'description' => $request->description
        ]);

        return response()->json(['message' => 'Commentaire mis à jour avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $publication_id)
    {
        // Find and delete the comment based on the comment ID and publication ID
        $comment = Commentaire::where('id', $id)
            ->where('publication_id', $publication_id)
            ->first();

        $comment->delete();
        return response()->json(['message' => 'Commentaire supprimé avec succès']);
    }
}
