<?php

namespace App\Http\Controllers;

use App\Models\GroupeManager;
use App\Http\Requests\StoreGroupeManagerRequest;
use App\Http\Requests\UpdateGroupeManagerRequest;
use Illuminate\Http\Request;

class GroupeManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = GroupeManager::orderBy('id', 'desc')->get();
        return response()->json($messages);
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
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        GroupeManager::create([
            'message' => $request->message,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'Message created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupeManager $groupeManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupeManager $groupeManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroupeManager $groupeManager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupeManager $groupeManager)
    {
        //
    }
}
