<?php

namespace App\Http\Controllers;

use App\Models\presenceCertificat;
use App\Http\Requests\StorepresenceCertificatRequest;
use App\Http\Requests\UpdatepresenceCertificatRequest;

class PresenceCertificatController extends Controller
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
    public function store(StorepresenceCertificatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(presenceCertificat $presenceCertificat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(presenceCertificat $presenceCertificat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepresenceCertificatRequest $request, presenceCertificat $presenceCertificat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(presenceCertificat $presenceCertificat)
    {
        //
    }

    public function getPresenceCertif($id){
        $participants = presenceCertificat::where('certificat4c_id', $id)->get();
        return response()->json($participants);
    }

}
