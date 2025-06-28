<?php

declare(strict_types=1);

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
    public function index(Request $request): View
    {
        $query = Project::query();

        // Filtering by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->whereDate('start_date', '<=', now())
                      ->whereDate('end_date', '>=', now());
            } elseif ($request->status === 'upcoming') {
                $query->whereDate('start_date', '>', now());
            } elseif ($request->status === 'finished') {
                $query->whereDate('end_date', '<', now());
            }
        }

        // Search by name or id
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('id', $search);
            });
        }

        // Sorting
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        if (in_array($sort, ['id', 'name', 'start_date', 'end_date']) && in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('id', 'desc');
        }

        $projects = $query->paginate(10)->appends($request->all());
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
        $tasks = $project->tasks()->with('assignedUser')->get();
        $members = $project->members;
        return view('admin.projects.show', compact('project', 'tasks', 'members'));
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
        $members = $project->members;
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
        $members = $project->members;
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
