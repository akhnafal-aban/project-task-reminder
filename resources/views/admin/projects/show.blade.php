@extends('layouts.app')

@section('content')
<main class="container mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold mb-2">{{ $project->name }}</h1>
        <div class="text-sm text-gray-400 mb-1">Kode: #{{ $project->id }}</div>
        <div class="mb-2">{{ $project->description }}</div>
        <div class="flex flex-wrap items-center gap-2 mb-2">
            <span class="font-semibold">Anggota Proyek:</span>
            @forelse($members as $member)
                <span class="px-2 py-1 rounded text-xs" style="color:#38d4ae; border:1px solid #38d4ae;">
                    {{ $member->name }}
                </span>
            @empty
                <span class="text-gray-400">Belum ada anggota</span>
            @endforelse
        </div>
        <a href="{{ route('admin.projects.tasks.create', $project) }}" class="btn mb-4 inline-block">+ Tambah Tugas</a>
    </div>

    <div>
        <h2 class="text-xl font-bold mb-4">Daftar Tugas</h2>
        @if($tasks->count())
            @foreach($tasks as $task)
                <div class="mb-4 p-4 rounded flex flex-col md:flex-row md:items-center justify-between" style="border:1px solid #26272b;">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-semibold text-lg" style="color:#38d4ae;">{{ $task->title }}</span>
                            <span class="text-xs px-2 py-0.5 rounded" style="color:#f3f4f6; border:1px solid #38d4ae;">
                                {{ is_string($task->priority) ? ucfirst($task->priority) : ($task->priority->value ?? (string)$task->priority) }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-400 mb-1">
                            Ditugaskan ke: <span style="color:#38d4ae;">
                                {{ $task->assignedUser ? $task->assignedUser->name : '-' }}
                            </span>
                        </div>
                        <div class="text-sm mb-1">Jatuh tempo: <span style="color:#f87171;">{{ $task->due_date ? date('d M Y', strtotime($task->due_date)) : '-' }}</span></div>
                        <div class="text-sm text-gray-300">{{ $task->description }}</div>
                    </div>
                    <div class="mt-2 md:mt-0 md:ml-4 flex items-center gap-2">
                        <a href="{{ route('admin.projects.tasks.edit', [$project, $task]) }}" class="btn btn-sm">Edit</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-gray-400">Belum ada tugas pada proyek ini.</div>
        @endif
    </div>
</main>
@endsection
