@extends('layouts.app')

@section('title', 'TugasKu')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6 text-[#38d4ae]">Daftar Tugas Saya</h1>
        <form method="GET" class="flex flex-wrap gap-4 items-end mb-6" id="task-filter-form">
            <div>
                <label for="search" class="block text-sm text-[#b3b3b3] mb-1">Cari Nama/ID</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari tugas..."
                    class="bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#38d4ae]"
                    onchange="this.form.submit()">
            </div>
            <div>
                <label for="sort" class="block text-sm text-[#b3b3b3] mb-1">Urutkan</label>
                <select name="sort" id="sort"
                    class="bg-[#18181b] text-[#b3b3b3] border border-[#38383f] rounded px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-[#38d4ae]"
                    style="background-position:right 0.75rem center;" onchange="this.form.submit()">
                    <option value="due_date" @if (request('sort') === 'due_date') selected @endif>Jatuh Tempo</option>
                    <option value="created_at" @if (request('sort') === 'created_at') selected @endif>Dibuat</option>
                </select>
            </div>
            <div>
                <label for="direction" class="block text-sm text-[#b3b3b3] mb-1">Arah</label>
                <select name="direction" id="direction"
                    class="bg-[#18181b] text-[#b3b3b3] border border-[#38383f] rounded px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-[#38d4ae]"
                    style="background-position:right 0.75rem center;" onchange="this.form.submit()">
                    <option value="asc" @if (request('direction') === 'asc') selected @endif>Naik</option>
                    <option value="desc" @if (request('direction') === 'desc') selected @endif>Turun</option>
                </select>
            </div>
        </form>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($tasks as $task)
                <div class="bg-[#232329] rounded-lg p-6 shadow border border-[#38383f]">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-xl font-semibold text-[#f3f4f6]">{{ $task->title }}</h2>
                        <span class="text-xs text-gray-400">#{{ $task->id }}</span>
                    </div>
                    <div>
                        <span
                            class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $task->priority->value === 'high' ? 'bg-red-500 text-white' : ($task->priority->value === 'medium' ? 'bg-yellow-500 text-black' : 'bg-green-500 text-black') }} border border-[#38383f]">
                            <svg class="inline w-4 h-4 mr-1 align-text-bottom" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 6v6l4 2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{ $task->priority->name }}
                        </span>
                        <span
                            class="inline-block px-2 py-1 rounded text-xs font-semibold border border-[#38383f] {{ $task->status->value === 'completed' ? 'bg-green-600 text-white' : ($task->status->value === 'in_progress' ? 'bg-blue-500 text-white' : 'bg-gray-500 text-white') }}">
                            <svg class="inline w-4 h-4 mr-1 align-text-bottom" fill="none" stroke="#fff"
                                stroke-width="2" viewBox="0 0 24 24">
                                @if ($task->status->value === 'completed')
                                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
                                @elseif($task->status->value === 'in_progress')
                                    <circle cx="12" cy="12" r="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M12 8v4l3 2" stroke-linecap="round" stroke-linejoin="round" />
                                @else
                                    <rect x="4" y="4" width="16" height="16" rx="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                @endif
                            </svg>
                            {{ $task->status->name }}
                        </span>
                    </div>
                    <div class="text-gray-300 mb-2">{{ $task->description }}</div>
                    <div class="text-sm text-gray-400 mb-2">Proyek: <span
                            class="text-[#38d4ae]">{{ $task->project->name ?? '-' }}</span></div>
                    <div class="text-sm mb-1">Jatuh tempo: <span
                            class="text-[#f87171]">{{ $task->due_date ? date('d M Y', strtotime($task->due_date)) : '-' }}</span>
                    </div>
                    <a href="{{ route('member.tasks.show', $task) }}"
                        class="inline-block mt-2 px-4 py-2 bg-[#38d4ae] text-[#18181b] rounded hover:bg-[#2bbd99] transition">Detail</a>
                </div>
            @empty
                <div class="col-span-2 text-center text-gray-400">Belum ada tugas yang di-assign.</div>
            @endforelse
        </div>
    </div>
@endsection
