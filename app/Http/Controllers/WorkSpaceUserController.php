<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use App\Models\WorkSpaceUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WorkSpaceUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Response()->json(WorkSpaceUser::all());
    }
    public function store(Request $request)
    {
        $request->validate([
            "user_id"=>"required",
            "workspace_id"=>"required"
        ]);
        WorkSpaceUser::create([
            "user_id"=>$request->user_id,
            "workspace_id"=>$request->workspace_id
        ]);
        return Response()->json(["success","assign a user to a work scpace"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workspace=Workspace::with(WorkSpaceUser::class)->where("id",$id);
        return Response()->json($workspace);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $workspace=WorkSpaceUser::find($id);
        if(!$workspace){
            return Response()->json(["failed","work space user not found"]);
        }else{
            $workspace->delete();
            return Response()->json(["success","delete with success"]);
        }
    }
}
