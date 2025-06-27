@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap md:flex-nowrap items-end justify-between gap-4 mb-6">
        <form id="task-filter-form" method="GET" action="{{ route('admin.tasks.index') }}" class="flex flex-wrap gap-4 items-end flex-1">
            <div>
                <label class="block text-sm text-[#b3b3b3] mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Task title..." class="bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#38d4ae]" onchange="this.form.submit()" />
            </div>
            <div>
                <label class="block text-sm text-[#b3b3b3] mb-1">Status</label>
                <select name="status" class="bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="">All</option>
                    @foreach(\App\Enums\TaskStatus::cases() as $status)
                        <option value="{{ $status->value }}" @selected(request('status') == $status->value)>{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm text-[#b3b3b3] mb-1">Priority</label>
                <select name="priority" class="bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="">All</option>
                    @foreach(\App\Enums\TaskPriority::cases() as $priority)
                        <option value="{{ $priority->value }}" @selected(request('priority') == $priority->value)>{{ $priority->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm text-[#b3b3b3] mb-1">Sort By</label>
                <select name="sort" class="bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="created_at" @selected(request('sort') == 'created_at')>Created</option>
                    <option value="due_date" @selected(request('sort') == 'due_date')>Due Date</option>
                    <option value="priority" @selected(request('sort') == 'priority')>Priority</option>
                </select>
            </div>
        </form>
        <div class="flex-0 ml-auto">
            <a href="{{ route('admin.tasks.create') }}" class="bg-[#38d4ae] text-[#18181b] px-4 py-2 rounded hover:bg-[#2bbd99] transition font-semibold whitespace-nowrap">+ Task</a>
        </div>
    </div>
    <div class="space-y-6">
        @forelse($tasks as $task)
            <div class="bg-[#232329] rounded-lg shadow p-6 flex flex-col md:flex-row md:items-center gap-4 border border-[#26272b] hover:border-[#38d4ae] transition">
                <div class="flex-1 min-w-0">
                    <div class="flex flex-col md:flex-row md:items-center md:gap-4 mb-2">
                        <h3 class="text-lg font-semibold text-[#38d4ae] truncate">{{ $task->title }}</h3>
                        <span class="ml-0 md:ml-2 text-xs text-[#b3b3b3] bg-[#18181b] px-2 py-1 rounded">#{{ $task->id }}</span>
                    </div>
                    <div class="flex flex-wrap gap-2 text-sm text-[#b3b3b3] mb-2">
                        <span><strong>Project:</strong> {{ $task->project->name ?? '-' }}</span>
                        <span><strong>Assignee:</strong> {{ $task->assignedUser->name ?? '-' }}</span>
                        <span><strong>Due:</strong> {{ $task->due_date ? $task->due_date->format('Y-m-d') : '-' }}</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-2">
                        <span class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $task->priority->value === 'high' ? 'bg-red-500 text-white' : ($task->priority->value === 'medium' ? 'bg-yellow-500 text-black' : 'bg-green-500 text-black') }}">
                            {{ $task->priority->name }}
                        </span>
                        <span class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $task->status->value === 'completed' ? 'bg-green-600 text-white' : ($task->status->value === 'in_progress' ? 'bg-blue-500 text-white' : 'bg-gray-500 text-white') }}">
                            {{ $task->status->name }}
                        </span>
                    </div>
                    <div class="flex gap-3 mt-2">
                        <a href="{{ route('admin.tasks.show', $task) }}" class="text-[#38d4ae] hover:underline font-medium">View</a>
                        <a href="{{ route('admin.tasks.edit', $task) }}" class="text-[#f3f4f6] hover:text-[#38d4ae] font-medium">Edit</a>
                        <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-[#e5484d] hover:text-[#f87171] font-medium ml-2">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="w-full md:w-72 mt-4 md:mt-0">
                    <div class="text-xs text-[#b3b3b3] mb-1 font-semibold">Random Comments</div>
                    @forelse($task->random_comments as $comment)
                        <div class="bg-[#18181b] rounded p-3 mb-2 border border-[#26272b]">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[#38d4ae] font-semibold">{{ $comment->user->name ?? 'Unknown' }}</span>
                                <span class="text-[#b3b3b3] text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="text-[#f3f4f6] text-sm">{{ $comment->comment }}</div>
                        </div>
                    @empty
                        <div class="text-[#b3b3b3] italic">No comments</div>
                    @endforelse
                </div>
            </div>
        @empty
            <div class="bg-[#232329] rounded-lg p-8 text-center text-[#b3b3b3]">No tasks found.</div>
        @endforelse
    </div>
    <div class="mt-6">
        {{ $tasks->withQueryString()->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection
