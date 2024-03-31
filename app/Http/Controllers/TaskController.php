<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project, Task $task)
    {
        $projects = $project->query()->get();
        $tasks = $task->query()->with('project')
            ->orderBy('priority', 'ASC')
            ->orderBy('created_at', 'ASC')->paginate(10);

        return view('task.index', compact('tasks', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $projects = $project->query()->get();
        
        return view('task.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());

        return back()->with('success', 'Task created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Task $task, Project $project)
    {
        $projects = $project->query()->get();
        $task = $task->findOrFail($id);
        
        return view('task.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task, $id)
    {
        $task = $task->findOrFail($id);
        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('success', 'Task Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task, $id)
    {
        $task = $task->findOrFail($id);
        $task->delete();

        return back()->with('success', 'Task deleted successfully');
    }

    public function reOrderTask(Request $request, Task $task)
    {
        $task = $task->findOrFail($request->input('task_id'));
        $prev = $task->find($request->input('prev_id'));

        if (! $request->input('prev_id')) {
            $destination = 1;
        } elseif (! $request->input('next_id')) {
            $destination = $task->count();
        } else {
            $destination = $task->priority < $prev->priority ? $prev->priority : $prev->priority + 1;
        }
        $task->where('priority', '>', $task->priority)
            ->where('priority', '<=', $destination)
            ->update(['priority' => DB::raw('priority - 1')]);

        $task->where('priority', '<', $task->priority)
            ->where('priority', '>=', $destination)
            ->update(['priority' => DB::raw('priority + 1')]);

        $task->priority = $destination;
        $task->save();

        return response()->json(true);
    }
}
