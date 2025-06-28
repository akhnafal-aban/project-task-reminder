<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskReminderMail;

class SendTaskReminders extends Command
{
    protected $signature = 'tasks:send-reminders';
    protected $description = 'Send daily email reminders to users with unfinished tasks';

    public function handle()
    {
        $users = User::whereHas('tasks', function ($q) {
            $q->where('status', '!=', 'completed');
        })->get();

        foreach ($users as $user) {
            $tasks = $user->tasks()->where('status', '!=', 'completed')->get();
            if ($tasks->count() > 0) {
                Mail::to($user->email)->send(new TaskReminderMail($user, $tasks));
                $this->info('Reminder sent to ' . $user->email);
            }
        }
        $this->info('All reminders sent.');
    }
}
