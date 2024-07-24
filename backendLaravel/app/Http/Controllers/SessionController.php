<?php

namespace App\Http\Controllers;

use App\Models\session;
use App\Http\Requests\StoresessionRequest;
use App\Http\Requests\UpdatesessionRequest;

class SessionController extends Controller
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
    public function store(StoresessionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesessionRequest $request, session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(session $session)
    {
        //
    }
}
