<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workspace;
use Illuminate\Http\Response;

class WorkSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $workspaces=Workspace::all();
       return Response()->json($workspaces);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "description"=>"required",
        ]);
        Workspace::Create([
            "name"=>$request->name,
            "description"=>$request->description,
            "user_id"=>$request->user_id,
        ]);
        return Response()->json(["reponse","sucess"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $workspace=Workspace::find($id);
         $request->validate([
            "name"=>"required",
            "description"=>"required",
         ]);
         if(!$workspace){
             return Response()->json(["erreur","workplace not found"]);
         }else{
             $workspace->update([
                "name"=>$request->name,
                "description"=>$request->description,
             ]);
             return Response()->json(["success","update with sucess"]);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $workspace=Workspace::find($id);
        if(!$workspace){
             return Response()->json(["erreur","workplace not found"]);
        }else{
            $workspace->delete();
            return Response()->json(["success","delete with success"]);
        }
    }
}
