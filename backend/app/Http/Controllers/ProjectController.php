<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectsCollection;
use App\Models\Project;
use App\Models\User;
use App\Policies\ProjectPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
  public function __construct()
  {
    $this->authorizeResource(Project::class,'project');
  }

    public function index ()
    {
      $projects = Auth::user()->projects()->with('tasks')->paginate();
      
      return new ProjectsCollection($projects);
    }
    public function indexMemberships ()
    {
      $projects = Auth::user()->memberships()->with('tasks')->paginate();
      
      return new ProjectsCollection($projects);
    }
    public function show (Request $requet,Project $project){
      // $projects = Project::all();
      return new ProjectResource($project);
    }
    public function store(StoreProjectRequest $request) 
    {
      $validated = $request->validated();
      $project = Auth::user()->projects()->create($validated);
      return response()->json([
        'message'=>"project created seccessfully",
        "project"=>$project
      ]);
    }
    public function update(UpdateProjectRequest $request,Project $project) 
    {
      $validated = $request->validated();
      $project->update($validated);
      return response()->json([
        'message'=>"project UPDATED seccessfully",
        "project"=>$project
      ]);
    }
    public function destroy (Request $request,Project $project)
    {
      $project->delete();
      return response()->noContent();
    }
    public function addMember (Request $request,Project $project)
    {
      $this->authorize('canAddMember', $project);
      $member = User::where('email',$request->email)->first();
      if($member){
     if (!$project->members->contains($member->id)) {
        $project->members()->attach([$member->id]);
        return response()->json([
          'project_title'=>$project->title,
          'project_members'=>$project->members(),
        ]);
    } else {
        return response()->json([
          'project_title'=>$project->title,
          'message'=>"this memeber all redy exist",
        ]);
    }
    }else{
      return response()->json([
        "message"=>"user not found",
      ],404);
    }
    }
}
