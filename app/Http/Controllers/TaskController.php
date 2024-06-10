<?php

namespace App\Http\Controllers;

use App\DataTables\TaskDataTable;
use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Spatie\Permission\Models\Role;

class TaskController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('role:admin|role:project-manager')->only(['index','create','store','edit', 'show', 'update','destory']);
    //     $this->middleware('role:team-memeber')->only(['tasks.index', 'task.show']);

    // }

    public function index(TaskDataTable $dataTable)
    {
        return $dataTable->render('tasks.index');
    }

    public function create()
    {
        $projects = Project::all(); 

        return view('tasks.create', compact('projects'));
    }

    public function store(TaskRequest $request)
    {
        $validatedData = $request->validated();
        
        Task::create($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show($id)
    {
        $task = Task::with('project')->findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $projects = Project::all();

        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(TaskRequest $request, string $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['success' => 'Task deleted successfully.']);

    }
}
