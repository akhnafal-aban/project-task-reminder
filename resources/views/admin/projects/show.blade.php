@extends('layouts.app')

@section('title', 'Detail Proyek')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-[#232329] rounded-lg p-6 shadow border border-[#38383f] mb-6">
        <h1 class="text-2xl font-bold text-[#38d4ae] mb-2">{{ $project->name }}</h1>
        <div class="text-sm text-gray-400 mb-1">Kode: #{{ $project->id }}</div>
        <div class="text-gray-300 mb-2">{{ $project->description }}</div>
        <div class="text-sm text-gray-400 mb-2">Dibuat oleh: <span class="text-[#38d4ae]">{{ $project->createdBy->name ?? '-' }}</span></div>
        <div class="flex flex-wrap gap-2 mb-2">
            <span class="font-semibold text-xs text-gray-400">Anggota:</span>
            @foreach($members as $member)
                <span class="px-2 py-1 rounded text-xs border border-[#38d4ae] text-[#38d4ae]">{{ $member->name }}</span>
            @endforeach
        </div>
        <a href="{{ route('admin.projects.tasks.create', $project) }}" class="inline-block mt-2 px-4 py-2 bg-[#38d4ae] text-[#18181b] rounded hover:bg-[#2bbd99] transition">+ Tambah Tugas</a>
    </div>
    <div class="bg-[#232329] rounded-lg p-6 shadow border border-[#38383f]">
        <h2 class="text-xl font-bold mb-4 text-[#38d4ae]">Daftar Tugas</h2>
        @if($tasks->count())
            <div class="space-y-4">
                @foreach($tasks as $task)
                    <div class="p-4 rounded flex flex-col md:flex-row md:items-center justify-between border border-[#26272b] bg-[#18181b]">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-semibold text-lg text-[#38d4ae]">{{ $task->title }}</span>
                                <span class="text-xs px-2 py-0.5 rounded border border-[#38d4ae] text-[#f3f4f6]">
                                    {{ is_string($task->priority) ? ucfirst($task->priority) : ($task->priority->value ?? (string)$task->priority) }}
                                </span>
                            </div>
                            <div class="text-sm text-gray-400 mb-1">
                                Ditugaskan ke: <span class="text-[#38d4ae]">
                                    {{ $task->assignedUser ? $task->assignedUser->name : '-' }}
                                </span>
                            </div>
                            <div class="text-sm mb-1">Jatuh tempo: <span class="text-[#f87171]">{{ $task->due_date ? date('d M Y', strtotime($task->due_date)) : '-' }}</span></div>
                            <div class="text-sm text-gray-300">{{ $task->description }}</div>
                        </div>
                        <div class="mt-2 md:mt-0 md:ml-4 flex items-center gap-2">
                            <a href="{{ route('admin.projects.tasks.edit', [$project, $task]) }}" class="px-3 py-1 bg-[#38d4ae] text-[#18181b] rounded hover:bg-[#2bbd99] transition text-xs font-semibold">Edit</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-gray-400">Belum ada tugas pada proyek ini.</div>
        @endif
    </div>
</div>
@endsection
