<?php

namespace App\Http\Controllers;

use App\DataTables\ProjectDataTable;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ProjectController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:admin')->only(['index','create', 'store','edit', 'show', 'update','destroy']);
    //     $this->middleware('role:project-manager'|'admin')->except(['index', 'show']);
    //     // $this->middleware('role:team-member')->only(['index', 'show']);
    // }

    public function index(ProjectDataTable $dataTable)
    {
        return $dataTable->render('projects.index');
    }

    public function create()
    {
        $teamMembers = $this->getTeamMember();

        return view('projects.create', compact('teamMembers'));
    }

    public function store(ProjectRequest $request)
    {
        $validatedData = $request->validated();
        
        Project::create($validatedData);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        $teamMembers = $this->getTeamMember();

        // dd($teamMembers);

        return view('projects.edit', compact('project','teamMembers'));
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.show', compact('project'));
    }

    public function update(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->validated());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json(['success' => 'Project deleted successfully.']);
    }
    
    public function getTeamMember() {
        $teamMemberRole = Role::where('name', 'team-member')->first();

        // Get all users with the "team-member" role
       return  User::whereHas('roles', function ($query) use ($teamMemberRole) {
            $query->where('role_id', $teamMemberRole->id);
        })->get();
    }
}
