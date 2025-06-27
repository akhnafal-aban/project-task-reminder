<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use Illuminate\View\View;
use App\Services\TaskCommentService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\StoreTaskRequest;
use App\Http\Requests\Admin\UpdateTaskRequest;
use App\Http\Requests\StoreTaskCommentRequest;

class TaskController extends Controller
{
    public function index(Project $project): View
    {
        $query = Task::where('project_id', $project->id);

        // Filter by assigned member
        if (request()->filled('member')) {
            $query->where('assigned_to', request('member'));
        }

        // Search by name or id
        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('id', $search);
            });
        }

        $tasks = $query->with(['assignedUser'])->latest()->paginate(10);

        // Ambil semua member yang terlibat di project
        $members = $project->assignedUsers;

        // Untuk setiap task, ambil 2 komentar acak
        foreach ($tasks as $task) {
            $task->random_comments = $task->comments()->with('user')->inRandomOrder()->limit(2)->get();
        }

        return view('admin.task.index', compact('project', 'tasks', 'members'));
    }

    public function show(Project $project, Task $task): View
    {
        if ($task->project_id !== $project->id) {
            abort(404);
        }
        $comments = $task->comments()->with('user')->latest()->get();
        return view('admin.task.show', compact('project', 'task', 'comments'));
    }

    public function store(StoreTaskRequest $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();
        $validated['project_id'] = $project->id;
        Task::create($validated);
        return redirect()->route('admin.task.index', $project)->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function update(UpdateTaskRequest $request, Project $project, Task $task): RedirectResponse
    {
        $validated = $request->validated();
        $task->update($validated);
        return redirect()->route('admin.task.index', $project)->with('success', 'Tugas berhasil diperbarui.');
    }

    public function storeComment(StoreTaskCommentRequest $request, Project $project, Task $task): RedirectResponse
    {
        if ($task->project_id !== $project->id) {
            abort(404);
        }
        $validated = $request->validated();
        $user = $request->user();
        app(TaskCommentService::class)->addComment($task, $user, $validated['comment']);
        return redirect()->route('admin.task.show', [$project, $task])->with('success', 'Komentar berhasil ditambahkan.');
    }
}
