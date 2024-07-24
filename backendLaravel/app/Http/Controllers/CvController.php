<?php

namespace App\Http\Controllers;

use App\Models\cv;
use App\Http\Requests\UpdatecvRequest;
use Illuminate\Http\Request;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
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
        cv::create([
            "cvAutomatique"=>"",
            "cvCharge"=>"",
            "cvAccredite"=>0,
            "user_id"=>$request->user_id,
        ]);

        return response()->json(["message"=>"cv Created"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(cv $cv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cv $cv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cv $cv)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cv $cv)
    {
        //
    }
    public function findByUserId( $idUser)
    {
        $cv = cv::where('user_id', $idUser )->first();
        if($cv){
            return response()->json(["data"=>$cv],200);
        }else{
            return response()->json(["message"=>"CV  Not Found"],404);
        }
    }
}
