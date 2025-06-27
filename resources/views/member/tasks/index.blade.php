@extends('layouts.app')

@section('title', 'TugasKu')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-[#38d4ae]">Daftar Tugas Saya</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($tasks as $task)
            <div class="bg-[#232329] rounded-lg p-6 shadow border border-[#38383f]">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-xl font-semibold text-[#f3f4f6]">{{ $task->title }}</h2>
                    <span class="text-xs text-gray-400">#{{ $task->id }}</span>
                </div>
                <div class="text-gray-300 mb-2">{{ $task->description }}</div>
                <div class="text-sm text-gray-400 mb-2">Proyek: <span class="text-[#38d4ae]">{{ $task->project->name ?? '-' }}</span></div>
                <div class="text-sm mb-1">Jatuh tempo: <span class="text-[#f87171]">{{ $task->due_date ? date('d M Y', strtotime($task->due_date)) : '-' }}</span></div>
                <a href="{{ route('member.tasks.show', $task) }}" class="inline-block mt-2 px-4 py-2 bg-[#38d4ae] text-[#18181b] rounded hover:bg-[#2bbd99] transition">Detail</a>
            </div>
        @empty
            <div class="col-span-2 text-center text-gray-400">Belum ada tugas yang di-assign.</div>
        @endforelse
    </div>
</div>
@endsection
