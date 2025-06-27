@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-1xl mx-auto bg-[#232329] rounded-lg shadow p-6 mb-8 border border-[#38383f]">
        <div class="flex items-center gap-4 mb-4">
            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-[#18181b] border-2 border-[#38d4ae]">
                <!-- Modern user profile icon -->
                <svg class="w-10 h-10 text-[#38d4ae]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2a7 7 0 1 1 0 14a7 7 0 0 1 0-14zm0 16c-4.418 0-8 1.79-8 4v2h16v-2c0-2.21-3.582-4-8-4z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-[#38d4ae] mb-1">{{ $user->name }}</h2>
                <div class="flex flex-wrap gap-4 text-sm text-[#b3b3b3]">
                    <span class="flex items-center gap-1"><svg class="w-4 h-4 text-[#4bbfa6]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="8" r="4"/></svg><span class="text-[#4bbfa6]">{{ $user->role->name ?? $user->role }}</span></span>
                    <span class="flex items-center gap-1"><svg class="w-4 h-4 text-[#4bbfa6]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="8" r="4"/></svg><span class="text-[#b3b3b3]">{{ $user->email }}</span></span>
                    <span class="flex items-center gap-1"><svg class="w-4 h-4 text-[#4bbfa6]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 21v-2a4 4 0 0 1 4-4h0a4 4 0 0 1 4 4v2"/><circle cx="12" cy="7" r="4"/></svg><span class="text-[#b3b3b3]">Bergabung: {{ $user->created_at->format('Y-m-d') }}</span></span>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-1xl mx-auto bg-[#232329] rounded-lg shadow p-6 mb-8 border border-[#38383f]">
        <h3 class="text-lg font-semibold text-[#38d4ae] mb-4 flex items-center gap-2"><svg class="w-5 h-5 text-[#38d4ae]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M16 3v4M8 3v4"/></svg>Projects</h3>
        @forelse($projects as $project)
            <div class="mb-4 p-4 rounded bg-[#18181b] border border-[#38383f] flex items-center justify-between">
                <div>
                    <div class="font-semibold text-[#f3f4f6]">{{ $project->name }}</div>
                    <div class="text-xs text-[#b3b3b3]">Tasks: {{ $project->tasks->count() }}</div>
                </div>
                <a href="{{ route('admin.projects.show', $project) }}" class="text-[#38d4ae] hover:underline text-xs font-semibold">Detail</a>
            </div>
        @empty
            <div class="text-[#b3b3b3] italic">No projects found.</div>
        @endforelse
    </div>
    <div class="max-w-1xl mx-auto bg-[#232329] rounded-lg shadow p-6 border border-[#38383f]">
        <h3 class="text-lg font-semibold text-[#38d4ae] mb-4 flex items-center gap-2"><svg class="w-5 h-5 text-[#38d4ae]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 17v-2a4 4 0 0 1 4-4h0a4 4 0 0 1 4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Tasks by Priority</h3>
        <div class="mb-4">
            <div class="font-semibold text-[#f3f4f6] mb-2 flex items-center gap-2"><span class="inline-block w-2 h-2 rounded-full bg-red-500"></span>High Priority</div>
            @forelse($highPriorityTasks as $task)
                <div class="bg-[#18181b] rounded p-3 mb-2 border border-[#26272b] flex justify-between items-center">
                    <a href="{{ route('admin.tasks.show', $task) }}" class="text-[#268d73] hover:underline text-base font-semibold">{{ $task->title }}</a>
                    <span class="text-xs px-2 py-1 rounded bg-red-500 text-white">High</span>
                </div>
            @empty
                <div class="text-[#b3b3b3] italic">No high priority tasks.</div>
            @endforelse
        </div>
        <div class="mb-4">
            <div class="font-semibold text-[#f3f4f6] mb-2 flex items-center gap-2"><span class="inline-block w-2 h-2 rounded-full bg-yellow-500"></span>Medium Priority</div>
            @forelse($mediumPriorityTasks as $task)
                <div class="bg-[#18181b] rounded p-3 mb-2 border border-[#26272b] flex justify-between items-center">
                    <a href="{{ route('admin.tasks.show', $task) }}" class="text-[#268d73] hover:underline text-base font-semibold">{{ $task->title }}</a>
                    <span class="text-xs px-2 py-1 rounded bg-yellow-500 text-black">Medium</span>
                </div>
            @empty
                <div class="text-[#b3b3b3] italic">No medium priority tasks.</div>
            @endforelse
        </div>
        <div>
            <div class="font-semibold text-[#f3f4f6] mb-2 flex items-center gap-2"><span class="inline-block w-2 h-2 rounded-full bg-green-500"></span>Low Priority</div>
            @forelse($lowPriorityTasks as $task)
                <div class="bg-[#18181b] rounded p-3 mb-2 border border-[#26272b] flex justify-between items-center">
                    <a href="{{ route('admin.tasks.show', $task) }}" class="text-[#268d73] hover:underline text-base font-semibold">{{ $task->title }}</a>
                    <span class="text-xs px-2 py-1 rounded bg-green-500 text-black">Low</span>
                </div>
            @empty
                <div class="text-[#b3b3b3] italic">No low priority tasks.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
