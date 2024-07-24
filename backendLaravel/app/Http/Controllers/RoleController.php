<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json(["data"=>$roles],200);
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
    public function store(StoreRoleRequest $request)
    {
        Role::create([
            "nomRole"=>$request->nomRole,
        ]);

        return response()->json(["message"=>"Role Created"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, $idRole)
    {
        $role = Role::findOrFail($idRole);
        if($role){

            $role->update([
                "nomRole"=>$request->nomRole,
            ]);

            return response()->json(["message"=>"Role Updated"],200);

        }else{
            return response()->json(["message"=>"Role Not Found"],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if($role){
            $role->delete();
            return response()->json(["message"=>"Delete With Success"],200);
        }else{
            return response()->json(["message"=>"Role Not Found"],404);
        }
    }

    public function finById($idRole)
    {
        $role = Role::find($idRole);
        if($role){
            return response()->json(["data"=>$role],200);
        }else{
            return response()->json(["message"=>"role Not Found"],404);
        }
    }

    public function findIdParticipant(){
        $participantRole = Role::where('nomRole', 'participant')->first();

        if ($participantRole) {
            return $participantRole->id;
        } else {
            return null;
        }
    }

    public function findIdManager(){
        $managerRole = Role::where('nomRole', 'manager')->first();

        if ($managerRole) {
            return $managerRole->id;
        } else {
            return null;
        }
    }

    public function findIdAdmin(){
        $adminRole = Role::where('nomRole', 'administrateur')->first();

        if ($adminRole) {
            return $adminRole->id;
        } else {
            return null;
        }
    }

    public function findIdResponsable(){
        $responsableRole = Role::where('nomRole', 'responsable')->first();

        if ($responsableRole) {
            return $responsableRole->id;
        } else {
            return null;
        }
    }

    public function getUserRole($roleId) {
        $role = Role::find($roleId);

        if (!$role) {
            return response()->json('Role not found');
        }

        return response()->json($role);
    }

}
