<?php

declare(strict_types=1);

namespace App\Http\Controllers;
use App\Http\Requests\StoreTaskCommentRequest;
use App\Models\Task;
use App\Services\TaskCommentService;
use Illuminate\Http\RedirectResponse;

class TaskCommentController extends Controller
{
    protected TaskCommentService $service;

    public function __construct(TaskCommentService $service)
    {
        $this->service = $service;
    }

    public function store(StoreTaskCommentRequest $request, Task $task): RedirectResponse
    {
        $this->service->addComment($task, $request->user(), $request->input('comment'));
        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
