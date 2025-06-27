@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-[#232329] rounded-lg shadow p-6 mb-8">
        <h2 class="text-2xl font-bold text-[#38d4ae] mb-2">{{ $user->name }}</h2>
        <div class="text-[#b3b3b3] mb-2">Email: <span class="text-[#f3f4f6]">{{ $user->email }}</span></div>
        <div class="text-[#b3b3b3] mb-2">Role: <span class="text-[#f3f4f6]">{{ $user->role->name ?? $user->role }}</span></div>
        <div class="text-[#b3b3b3] mb-2">Joined: <span class="text-[#f3f4f6]">{{ $user->created_at->format('Y-m-d') }}</span></div>
    </div>
    <div class="max-w-2xl mx-auto bg-[#232329] rounded-lg shadow p-6 mb-8">
        <h3 class="text-lg font-semibold text-[#38d4ae] mb-4">Projects</h3>
        @forelse($projects as $project)
            <div class="mb-4">
                <div class="font-semibold text-[#f3f4f6]">{{ $project->name }}</div>
                <div class="text-xs text-[#b3b3b3]">Tasks: {{ $project->tasks->count() }}</div>
            </div>
        @empty
            <div class="text-[#b3b3b3] italic">No projects found.</div>
        @endforelse
    </div>
    <div class="max-w-2xl mx-auto bg-[#232329] rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-[#38d4ae] mb-4">Tasks by Priority</h3>
        <div class="mb-4">
            <div class="font-semibold text-[#f3f4f6] mb-2">High Priority</div>
            @forelse($highPriorityTasks as $task)
                <div class="bg-[#18181b] rounded p-3 mb-2 border border-[#26272b]">
                    <div class="flex justify-between items-center">
                        <span class="text-[#f3f4f6]">{{ $task->title }}</span>
                        <span class="text-xs px-2 py-1 rounded bg-red-500 text-white">High</span>
                    </div>
                </div>
            @empty
                <div class="text-[#b3b3b3] italic">No high priority tasks.</div>
            @endforelse
        </div>
        <div class="mb-4">
            <div class="font-semibold text-[#f3f4f6] mb-2">Medium Priority</div>
            @forelse($mediumPriorityTasks as $task)
                <div class="bg-[#18181b] rounded p-3 mb-2 border border-[#26272b]">
                    <div class="flex justify-between items-center">
                        <span class="text-[#f3f4f6]">{{ $task->title }}</span>
                        <span class="text-xs px-2 py-1 rounded bg-yellow-500 text-black">Medium</span>
                    </div>
                </div>
            @empty
                <div class="text-[#b3b3b3] italic">No medium priority tasks.</div>
            @endforelse
        </div>
        <div>
            <div class="font-semibold text-[#f3f4f6] mb-2">Low Priority</div>
            @forelse($lowPriorityTasks as $task)
                <div class="bg-[#18181b] rounded p-3 mb-2 border border-[#26272b]">
                    <div class="flex justify-between items-center">
                        <span class="text-[#f3f4f6]">{{ $task->title }}</span>
                        <span class="text-xs px-2 py-1 rounded bg-green-500 text-black">Low</span>
                    </div>
                </div>
            @empty
                <div class="text-[#b3b3b3] italic">No low priority tasks.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
