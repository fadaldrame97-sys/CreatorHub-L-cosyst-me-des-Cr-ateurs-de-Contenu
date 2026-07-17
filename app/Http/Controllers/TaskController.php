<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Response()->json(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "status"=>"required|string",
            "description"=>"required",
            "title"=>"required",
            "assigned_to"=>"required",
            "workspace_id"=>"required"
        ]);
        Task::create([
           "status"=>$request->status,
            "description"=>$request->description,
            "title"=>$request->title,
            "assigned_to"=>$request->assigned_to,
            "workspace_id"=>$request->workspace_id
        ]);
        return Response()->json(["success","task create with success"]);
    }


    public function show(string $id)
    {
        $task=Task::find($id);
        if(!$task){
            return Response()->json(["ereur","task not find"]);
        }else{
            return Response()->json($task);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task=Task::find($id);
        if(!$task){
            return Response()->json(["ereur","task not find"]);
        }else{
            $request->validate([
            "status"=>"required|string",
            ]);
            $task->update([
                "status"=>$request->status
            ]);
            return Response()->json(["success","status update with success"]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     $task=Task::find($id);
        if(!$task){
            return Response()->json(["ereur","task not find"]);
        }else{
             $task->delete();
            return Response()->json(["success","delete task with success"]);
        }
    }
    public function assigneTask($id,Request $request){
        $task=Task::find($id);
        if(!$task){
            return Response()->json(["ereur","task not find"]);
        }else{
            $task->update([
            "assigned_to"=>$request->assigned_to,
            ]);
            return Response()->json(["success","asign worker to a task "]);
        }
    }
    public function validateTask($id,Request $request){
       $task=Task::find($id);
        if(!$task){
            return Response()->json(["ereur","task not find"]);
        }else{
            $task->update([
            "status"=>$request->status,
            ]);
            return Response()->json(["success","validate task"]);
        }
    }
    public function invalidateTask($id,Request $request){
       $task=Task::find($id);
        if(!$task){
            return Response()->json(["ereur","task not find"]);
        }else{
            $task->update([
            "status"=>$request->status,
            ]);
            return Response()->json(["success","invalidate task"]);
        }
    }

}
