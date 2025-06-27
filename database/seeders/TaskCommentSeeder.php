<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskComment;
use App\Models\User;
use Illuminate\Database\Seeder;

final class TaskCommentSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = Task::all();
        $users = User::all();

        foreach ($tasks as $task) {
            // Create 1-4 comments for each task
            $commentCount = rand(1, 4);
            
            for ($i = 0; $i < $commentCount; $i++) {
                $this->createTaskComment($task, $users);
            }
        }

        // Create additional random comments
        TaskComment::factory()->count(30)->create();
    }

    private function createTaskComment(Task $task, $users): void
    {
        $commenter = $users->random();
        
        // Create contextual comments based on task status and priority
        if ($task->status === 'completed') {
            TaskComment::factory()->positive()->create([
                'task_id' => $task->id,
                'user_id' => $commenter->id,
            ]);
        } elseif ($task->priority === 'high' && $task->status === 'not_started') {
            TaskComment::factory()->issue()->create([
                'task_id' => $task->id,
                'user_id' => $commenter->id,
            ]);
        } elseif ($task->status === 'in_progress') {
            TaskComment::factory()->create([
                'task_id' => $task->id,
                'user_id' => $commenter->id,
                'comment' => $this->getProgressComment($task),
            ]);
        } else {
            TaskComment::factory()->create([
                'task_id' => $task->id,
                'user_id' => $commenter->id,
            ]);
        }
    }

    private function getProgressComment(Task $task): string
    {
        $progressComments = [
            'Progress saat ini sudah mencapai 60%, diperkirakan selesai dalam 3 hari.',
            'Implementasi sudah berjalan dengan baik, tinggal finishing touches.',
            'Testing sedang dilakukan, hasilnya cukup memuaskan.',
            'Integrasi dengan sistem lain sudah berhasil, tinggal optimasi.',
            'Code review sudah selesai, feedback sudah diimplementasi.',
            'Deployment ke staging environment berhasil, siap untuk testing.',
            'Dokumentasi sudah diperbarui sesuai dengan perubahan terbaru.',
            'Performance testing menunjukkan hasil yang baik.',
            'Security audit sudah selesai, tidak ada vulnerability.',
            'User acceptance testing sudah dilakukan, feedback positif.',
        ];

        return $progressComments[array_rand($progressComments)];
    }
} 