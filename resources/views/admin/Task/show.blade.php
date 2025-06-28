@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-[#232329] rounded-lg p-6 shadow border border-[#38383f] mb-6">
        <h1 class="text-2xl font-bold text-[#38d4ae] mb-2">{{ $task->title }}</h1>
        <div class="text-gray-300 mb-2">{{ $task->description }}</div>
        <div class="text-sm text-gray-400 mb-2">Proyek: <span class="text-[#38d4ae]">{{ $task->project->name ?? '-' }}</span></div>
        <div class="text-sm mb-1">Jatuh tempo: <span class="text-[#f87171]">{{ $task->due_date ? date('d M Y', strtotime($task->due_date)) : '-' }}</span></div>
        <div class="text-sm mb-1">Status: <span class="text-[#38d4ae]">
            {{ is_string($task->status) ? ucfirst($task->status) : ucfirst($task->status->value) }}
        </span></div>
        <div class="flex gap-2 mt-4">
            <a href="{{ route('admin.tasks.edit', $task) }}" class="text-[#f3f4f6] hover:text-[#38d4ae] font-medium">Edit</a>
            <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-[#e5484d] hover:text-[#f87171] font-medium ml-2">Hapus</button>
            </form>
        </div>
    </div>
    <div class="bg-[#232329] rounded-lg p-6 shadow border border-[#38383f]">
        <h2 class="text-lg font-semibold text-[#38d4ae] mb-2">Komentar</h2>
        <form action="{{ route('admin.tasks.comment', $task) }}" method="POST" class="mb-4 flex gap-2">
            @csrf
            <input type="text" name="comment" class="flex-1 px-3 py-2 rounded border border-gray-700 bg-transparent text-[#f3f4f6]" placeholder="Tulis komentar..." required value="{{ old('comment') }}">
            <button type="submit" class="px-4 py-2 bg-[#38d4ae] text-[#18181b] rounded hover:bg-[#2bbd99] transition">Kirim</button>
        </form>
        @error('comment')<div class="text-red-400 text-xs mb-2">{{ $message }}</div>@enderror
        <div class="space-y-2">
            @forelse($comments as $comment)
                <div class="p-3 rounded bg-[#18181b] border border-[#38383f]">
                    <div class="text-xs text-gray-400 mb-1">{{ $comment->user->name ?? '-' }} - {{ $comment->created_at->diffForHumans() }}</div>
                    <div class="text-[#f3f4f6]">{{ $comment->comment }}</div>
                </div>
            @empty
                <div class="text-gray-400">Belum ada komentar.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
