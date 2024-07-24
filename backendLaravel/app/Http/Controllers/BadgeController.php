<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Http\Requests\StoreBadgeRequest;
use App\Http\Requests\UpdateBadgeRequest;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $badges = Badge::all();
        return response()->json(["data"=>$badges],200);
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
    public function store(StoreBadgeRequest $request)
    {
        Badge::Create([
            "nom" => $request->nom,
            "type" => $request->type,
            "image" => $request->image,
            "choix" => $request->choix,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Badge $badge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $Badge=Badge::find($id);
        return response()->json($Badge);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $Badge = Badge::findOrFail($id);
        $Badge->update($request->all());
        return response()->json(["message" => "Badge mis à jour avec succès"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Badge $badge)
    {
        //
    }

    public function count(Badge $badge){
        $count = Badge::count();
        return response()->json(['count' => $count]);
    }

}
