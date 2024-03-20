<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Policies\TaskPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
     public function __construct()
  {
    $this->authorizeResource(Task::class,'task');
  }
    public function index()
    {
        $tasks = Task::where('creator_id',Auth::id())->paginate(10);
        return  new TaskCollection(
             $tasks
        );
    }
    public function show(Request $request,Task $task)
    {
        
        return new TaskResource(
            $task
        );
    }
    public function store(Request $request)
    {
       $validated = $request->validate([
            'title' => 'required|max:255',
            'is_done' => 'boolean',
            'project_id' => [
                'nullable',
                Rule::in(Auth::user()->memberships()->pluck('id'))
            ],
        ]);
        Auth::user()->tasks()->create($validated);
        return response()->json(['message' => 'tasck created seccussfully']);
    }
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'sometimes|required|max:255',
            'is_done' => 'boolean',
            'project_id' => [
                'nullable',
                Rule::exists('projects','id')->where(function ($query){
                    $query->where('creator_id',Auth::id());
                })
            ],
        ]);
        $task->update($request->all());
        return response()->json(['message' => 'tasck updated seccussfully']);
    }
    public function destroy(Request $request, Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'tasck deleted seccussfully']);
    }
}
