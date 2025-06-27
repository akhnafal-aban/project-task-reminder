<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\StoreTaskRequest;
use App\Http\Requests\Admin\UpdateTaskRequest;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Http\Requests\Admin\AssignProjectMembersRequest;


class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.projects.create');
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['created_by'] = optional(Auth::user())->id;
        Project::create($validated);
        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil dibuat.');
    }

    public function show(Project $project): View
    {
        $membersData = [];
        foreach ($project->assignedUsers as $member) {
            $membersData[] = [
                'user' => $member,
                'tasks' => $member->assignedTasks()->where('project_id', $project->id)->get(),
            ];
        }
        return view('admin.projects.show', compact('project', 'membersData'));
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();
        $project->update($validated);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    public function createTask(Project $project): View
    {
        $members = $project->assignedUsers;
        return view('admin.projects.tasks-create', compact('project', 'members'));
    }

    public function storeTask(StoreTaskRequest $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();
        $validated['project_id'] = $project->id;
        Task::create($validated);
        return redirect()->route('admin.projects.show', $project)->with('success', 'Tugas berhasil ditambahkan.');
    }
    public function editTask(Project $project, Task $task): View
    {
        // Pastikan task milik project yang sama
        if ($task->project_id !== $project->id) {
            abort(404);
        }
        $members = $project->assignedUsers;
        return view('admin.projects.tasks-edit', compact('project', 'task', 'members'));
    }

    public function updateTask(UpdateTaskRequest $request, Project $project, Task $task): RedirectResponse
    {
        // Pastikan task milik project yang sama
        if ($task->project_id !== $project->id) {
            abort(404);
        }
        $validated = $request->validated();
        $task->update($validated);
        return redirect()->route('admin.projects.show', $project)->with('success', 'Tugas berhasil diperbarui.');
    }
}
