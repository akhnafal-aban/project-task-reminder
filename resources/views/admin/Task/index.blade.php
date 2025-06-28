@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
        <form id="task-filter-form" method="GET" action="{{ route('admin.tasks.index') }}" class="flex flex-wrap gap-4 items-end flex-1">
            <div>
                <label for="search" class="block text-sm text-[#b3b3b3] mb-1">Cari Judul/ID</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari tugas..." class="bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#38d4ae]" onchange="this.form.submit()">
            </div>
            <div>
                <label for="status" class="block text-sm text-[#b3b3b3] mb-1">Status</label>
                <select name="status" id="status" class="bg-[#18181b] text-[#b3b3b3] border border-[#38383f] rounded px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-[#38d4ae]" style="background-position:right 0.75rem center;" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    @foreach(\App\Enums\TaskStatus::cases() as $status)
                        <option value="{{ $status->value }}" @selected(request('status') == $status->value)>{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="priority" class="block text-sm text-[#b3b3b3] mb-1">Prioritas</label>
                <select name="priority" id="priority" class="bg-[#18181b] text-[#b3b3b3] border border-[#38383f] rounded px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-[#38d4ae]" style="background-position:right 0.75rem center;" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    @foreach(\App\Enums\TaskPriority::cases() as $priority)
                        <option value="{{ $priority->value }}" @selected(request('priority') == $priority->value)>{{ $priority->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="sort" class="block text-sm text-[#b3b3b3] mb-1">Urutkan</label>
                <select name="sort" id="sort" class="bg-[#18181b] text-[#b3b3b3] border border-[#38383f] rounded px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-[#38d4ae]" style="background-position:right 0.75rem center;" onchange="this.form.submit()">
                    <option value="created_at" @selected(request('sort') == 'created_at')>Dibuat</option>
                    <option value="due_date" @selected(request('sort') == 'due_date')>Jatuh Tempo</option>
                    <option value="priority" @selected(request('sort') == 'priority')>Prioritas</option>
                </select>
            </div>
        </form>
        <div class="flex md:ml-4 mt-4 md:mt-0">
            <a href="{{ route('admin.tasks.create') }}" class="bg-[#38d4ae] text-[#18181b] px-4 py-2 rounded hover:bg-[#2bbd99] transition font-semibold whitespace-nowrap w-full md:w-auto text-center">+ Tambah Tugas</a>
        </div>
    </div>
    <div class="space-y-6">
        @forelse($tasks as $task)
            <div class="bg-[#232329] rounded-lg shadow p-6 border border-[#38383f] transition">
                <div class="flex flex-col gap-2">
                    <div class="flex flex-col md:flex-row md:items-center md:gap-4 mb-2">
                        <h3 class="text-lg font-semibold text-[#38d4ae] truncate">{{ $task->title }}</h3>
                        <span class="ml-0 md:ml-2 text-xs text-[#b3b3b3] bg-[#18181b] px-2 py-1 rounded">#{{ $task->id }}</span>
                    </div>
                    <div class="flex flex-wrap gap-2 text-sm text-[#b3b3b3] mb-2">
                        <span><strong>Proyek:</strong> {{ $task->project->name ?? '-' }}</span>
                        <span><strong>Ditugaskan:</strong> {{ $task->assignedUser->name ?? '-' }}</span>
                        <span><strong>Jatuh Tempo:</strong> {{ $task->due_date ? $task->due_date->format('Y-m-d') : '-' }}</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-2">
                        <span class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $task->priority->value === 'high' ? 'bg-red-500 text-white' : ($task->priority->value === 'medium' ? 'bg-yellow-500 text-black' : 'bg-green-500 text-black') }} border border-[#38383f]">
                            <svg class="inline w-4 h-4 mr-1 align-text-bottom" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6v6l4 2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            {{ $task->priority->name }}
                        </span>
                        <span class="inline-block px-2 py-1 rounded text-xs font-semibold border border-[#38383f] {{ $task->status->value === 'completed' ? 'bg-green-600 text-white' : ($task->status->value === 'in_progress' ? 'bg-blue-500 text-white' : 'bg-gray-500 text-white') }}">
                            <svg class="inline w-4 h-4 mr-1 align-text-bottom" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                                @if($task->status->value === 'completed')
                                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/>
                                @elseif($task->status->value === 'in_progress')
                                    <circle cx="12" cy="12" r="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 8v4l3 2" stroke-linecap="round" stroke-linejoin="round"/>
                                @else
                                    <rect x="4" y="4" width="16" height="16" rx="2" stroke-linecap="round" stroke-linejoin="round"/>
                                @endif
                            </svg>
                            {{ $task->status->name }}
                        </span>
                    </div>
                    <div class="flex gap-3 mt-2">
                        <a href="{{ route('admin.tasks.show', $task) }}" class="text-[#38d4ae] hover:underline font-medium">Lihat</a>
                        <a href="{{ route('admin.tasks.edit', $task) }}" class="text-[#f3f4f6] hover:text-[#38d4ae] font-medium">Edit</a>
                        <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus tugas ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-[#e5484d] hover:text-[#f87171] font-medium ml-2">Hapus</button>
                        </form>
                    </div>
                </div>
                <div class="w-full mt-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-[#38d4ae]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span class="text-sm font-semibold text-[#38d4ae] uppercase tracking-wide">Komentar Acak</span>
                    </div>
                    <div class="space-y-2">
                        @forelse($task->random_comments as $comment)
                            <div class="p-3 rounded bg-[#18181b] border border-[#38383f]">
                                <div class="text-xs text-gray-400 mb-1">{{ $comment->user->name ?? '-' }} - {{ $comment->created_at->diffForHumans() }}</div>
                                <div class="text-[#f3f4f6]">{{ $comment->comment }}</div>
                            </div>
                        @empty
                            <div class="text-[#b3b3b3] italic">Tidak ada komentar</div>
                        @endforelse
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-[#232329] rounded-lg p-8 text-center text-[#b3b3b3]">Tidak ada tugas ditemukan.</div>
        @endforelse
    </div>
    <div class="mt-6">
        {{ $tasks->withQueryString()->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection
