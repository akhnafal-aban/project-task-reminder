<?php

declare(strict_types=1);

namespace App\Models;

use App\TaskPriority;
use App\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'assigned_to',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'reminder_sent',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'datetime',
            'reminder_sent' => 'boolean',
            'status' => TaskStatus::class,
            'priority' => TaskPriority::class,
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TaskComment::class);
    }

    public function isOverdue(): bool
    {
        return !$this->status->isCompleted() && $this->due_date < now()->toDateString();
    }

    public function isDueToday(): bool
    {
        return \Carbon\Carbon::parse($this->due_date)->isToday();
    }

    public function isDueSoon(): bool
    {
        return \Carbon\Carbon::parse($this->due_date)->diffInDays(now()) <= 3 && !$this->isOverdue();
    }

    public function getPriorityColor(): string
    {
        return $this->priority->color();
    }

    public function getStatusColor(): string
    {
        return $this->status->color();
    }

    public static function newFactory()
    {
        return \Database\Factories\TaskFactory::new();
    }
}
