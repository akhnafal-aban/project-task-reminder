<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Services\TaskCommentService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\StoreTaskRequest;
use App\Http\Requests\Admin\UpdateTaskRequest;
use App\Http\Requests\StoreTaskCommentRequest;

class TaskController extends Controller
{
    public function index(): View
    {
        $query = Task::query();

        // Filter by status
        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }
        // Filter by priority
        if (request()->filled('priority')) {
            $query->where('priority', request('priority'));
        }
        // Search by name or id
        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('id', $search);
            });
        }
        // Sort
        $sort = request('sort', 'created_at');
        $query->orderBy($sort, $sort === 'priority' ? 'desc' : 'desc');

        $tasks = $query->with(['assignedUser', 'project'])->paginate(10);

        $projects = Project::all();
        $users = User::all();

        foreach ($tasks as $task) {
            $task->random_comments = $task->comments()->with('user')->inRandomOrder()->limit(2)->get();
        }

        return view('admin.task.index', compact('tasks', 'projects', 'users'));
    }

    public function show(Task $task): View
    {
        $comments = $task->comments()->with('user')->latest()->get();
        return view('admin.task.show', compact('task', 'comments'));
    }

    public function create(): View
    {
        $projects = Project::all();
        $users = User::all();
        return view('admin.task.create', compact('projects', 'users'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Task::create($validated);
        return redirect()->route('admin.tasks.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $validated = $request->validated();
        $task->update($validated);
        return redirect()->route('admin.tasks.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function storeComment(StoreTaskCommentRequest $request, Task $task): RedirectResponse
    {
        $validated = $request->validated();
        $user = $request->user();
        app(TaskCommentService::class)->addComment($task, $user, $validated['comment']);
        return redirect()->route('admin.tasks.show', $task)
            ->withFragment('comments')
            ->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()->route('admin.tasks.index')->with('success', 'Tugas berhasil dihapus.');
    }

    public function edit(Task $task): View
    {
        $projects = Project::all();
        $users = User::all();
        return view('admin.task.edit', compact('task', 'projects', 'users'));
    }
}
