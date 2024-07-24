<?php

namespace App\Http\Controllers;

use App\Models\React;
use App\Http\Requests\StoreReactRequest;
use App\Http\Requests\UpdateReactRequest;
use App\Models\Publication;
use Illuminate\Http\Request;

class ReactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($Publication_id, $User_id)
    {
        $React = React::where('publication_id', $Publication_id)
            ->where('user_id', $User_id)
            ->first();

        return response()->json($React);
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

        React::create([
            "type" => $request->type,
            "publication_id" => $request->publication_id,
            "user_id" => $request->user_id,
        ]);

        return response()->json(['message' => 'React created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(React $react)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(React $react)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReactRequest $request, React $react)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Publication_id, $User_id)
    {
        $react = React::where('publication_id', $Publication_id)
            ->where('user_id', $User_id)
            ->first();
        $react->delete();

        return response()->json(['message' => 'React deleted successfully']);
    }

    public function nbReact($Publication_id){
        $nb=React::where('publication_id', $Publication_id)->count();
        return response()->json($nb);
    }
}
