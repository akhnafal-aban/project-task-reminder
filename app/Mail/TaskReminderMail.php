<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Collection;

class TaskReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $tasks;

    public function __construct(User $user, Collection $tasks)
    {
        $this->user = $user;
        $this->tasks = $tasks;
    }

    public function build()
    {
        return $this->subject('Daily Task Reminder')
            ->view('emails.task_reminder');
    }
}
