<?php

declare(strict_types=1);

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Task;
use App\Models\TaskComment;
use App\Services\TaskCommentService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Member\UpdateTaskStatusRequest;

final class TaskController extends Controller
{
    // Menampilkan daftar tugas yang di-assign ke user
    public function index(): View
    {
        $user = Auth::user();
        $tasks = $user->tasks()->with('project')->get();
        return view('member.tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    // Menampilkan detail tugas dan komentar
    public function show(Task $task): View
    {
        $task->load(['project', 'comments.user']);
        return view('member.tasks.show', [
            'task' => $task,
        ]);
    }

    // Update status tugas
    public function updateStatus(UpdateTaskStatusRequest $request, Task $task): RedirectResponse
    {
        $task->update(['status' => $request->validated('status')]);
        return back()->with('success', 'Status tugas diperbarui.');
    }

    // Menambahkan komentar
    public function addComment(Request $request, Task $task): RedirectResponse
    {
        $request->validate(['comment' => 'required|string']);
        app(TaskCommentService::class)->addComment($task, Auth::user(), $request->comment);
        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
