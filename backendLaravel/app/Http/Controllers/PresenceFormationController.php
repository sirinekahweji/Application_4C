<?php

namespace App\Http\Controllers;

use App\Models\presenceFormation;
use App\Http\Requests\StorepresenceFormationRequest;
use App\Http\Requests\UpdatepresenceFormationRequest;

class PresenceFormationController extends Controller
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
    public function store(StorepresenceFormationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(presenceFormation $presenceFormation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(presenceFormation $presenceFormation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepresenceFormationRequest $request, presenceFormation $presenceFormation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(presenceFormation $presenceFormation)
    {
        //
    }
    /*public function getPresenceFormation($id){
        $participants = presenceFormation::where('certificat4c_id', $id)->get();
        return response()->json($participants);
    }*/
}
