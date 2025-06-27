<?php

namespace App\Services;

use App\Models\TaskComment;
use App\Models\Task;
use App\Models\User;

class TaskCommentService
{
    /**
     * Tambahkan komentar ke task tertentu
     *
     * @param Task $task
     * @param User $user
     * @param string $comment
     * @return TaskComment
     */
    public function addComment(Task $task, User $user, string $comment): TaskComment
    {
        return TaskComment::create([
            'task_id' => $task->id,
            'user_id' => $user->id,
            'comment' => $comment,
        ]);
    }
}
