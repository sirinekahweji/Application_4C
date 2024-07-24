<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($responsableID)
    {
        $publications = Publication::where('responsable_id', $responsableID)->orderBy('id', 'desc')->get();
        return response()->json($publications);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $publication =Publication::create([
                "description"=>$request->description,
                "responsable_id"=>$request->responsable_id,
                "cible"=>"public",
            ]);

        return response()->json($publication);
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        return response()->json($publication);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
            'titre' => 'required|string',
            'cible' => 'required|string',
        ]);

        $publication = Publication::findOrFail($id);

        $publication->update([
            'description' => $request->description,
            'titre' => $request->titre,
            'cible' => $request->cible,
        ]);

        return response()->json([
            'message' => 'Publication updated successfully',
            'publication' => $publication
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $publication = Publication::find($id);
        $publication->delete();

        return response()->json(['message' => 'Publication deleted successfully']);
    }
}
