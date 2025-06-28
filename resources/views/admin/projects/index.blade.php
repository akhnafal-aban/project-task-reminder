@extends('layouts.app')

@section('title', 'Manajemen Proyek')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
            <form method="GET" class="flex flex-wrap gap-4 items-end flex-1" id="project-filter-form">
                <div>
                    <label for="search" class="block text-sm text-[#b3b3b3] mb-1">Cari Nama/ID</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Cari proyek..."
                        class="bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#38d4ae]"
                        onchange="this.form.submit()">
                </div>
                <div>
                    <label for="status" class="block text-sm text-[#b3b3b3] mb-1">Status</label>
                    <select name="status" id="status"
                        class="bg-[#18181b] text-[#b3b3b3] border border-[#38383f] rounded px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-[#38d4ae]"
                        style="background-position:right 0.75rem center;" onchange="this.form.submit()">
                        <option value="">Semua</option>
                        <option value="active" @if (request('status') === 'active') selected @endif>Aktif</option>
                        <option value="upcoming" @if (request('status') === 'upcoming') selected @endif>Akan Datang</option>
                        <option value="finished" @if (request('status') === 'finished') selected @endif>Selesai</option>
                    </select>
                </div>
                <div>
                    <label for="sort" class="block text-sm text-[#b3b3b3] mb-1">Urutkan</label>
                    <select name="sort" id="sort"
                        class="bg-[#18181b] text-[#b3b3b3] border border-[#38383f] rounded px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-[#38d4ae]"
                        style="background-position:right 0.75rem center;" onchange="this.form.submit()">
                        <option value="id" @if (request('sort') === 'id') selected @endif>ID</option>
                        <option value="name" @if (request('sort') === 'name') selected @endif>Nama</option>
                        <option value="start_date" @if (request('sort') === 'start_date') selected @endif>Tanggal Mulai</option>
                        <option value="end_date" @if (request('sort') === 'end_date') selected @endif>Tanggal Selesai</option>
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
            <div class="flex md:ml-4 mt-4 md:mt-0">
                <a href="{{ route('admin.projects.create') }}"
                    class="bg-[#38d4ae] text-[#18181b] px-4 py-2 rounded hover:bg-[#2bbd99] transition font-semibold whitespace-nowrap w-full md:w-auto text-center">+
                    Tambah Proyek</a>
            </div>
        </div>
        @if (session('success'))
            <div class="bg-green-700 text-green-100 rounded px-4 py-2 mb-4">{{ session('success') }}</div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($projects as $project)
                <div class="bg-[#232329] rounded-lg p-6 shadow border border-[#38383f] flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="text-xl font-semibold text-[#f3f4f6]">{{ $project->name }}</h2>
                            <span class="text-xs text-gray-400">#{{ $project->id }}</span>
                        </div>
                        <div class="text-gray-300 mb-2">{{ $project->description }}</div>
                        <div class="flex items-center gap-2 text-sm text-gray-400 mb-2">
                            <svg class="w-4 h-4 text-[#38d4ae]" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="12" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Dibuat oleh:</span>
                            <span class="text-[#38d4ae] font-semibold ml-1">{{ $project->createdBy->name ?? '-' }}</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-2 items-center">
                            <span class="font-semibold text-xs text-gray-400 flex items-center gap-1">
                                <svg class="w-4 h-4 text-[#38d4ae]" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M17 21v-2a4 4 0 0 0-3-3.87" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9 21v-2a4 4 0 0 1 3-3.87" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="12" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Anggota:
                            </span>
                            @php $members = $project->tasks->pluck('assignedUser')->unique('id')->filter(); @endphp
                            @forelse ($members as $member)
                                <span
                                    class="flex items-center gap-1 px-2 py-1 rounded text-xs border border-[#38d4ae] text-[#38d4ae] bg-[#18181b] font-medium">
                                    <svg class="w-3 h-3 text-[#38d4ae]" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                    </svg>
                                    {{ $member->name }}
                                </span>
                            @empty
                                <span class="italic text-gray-500">Belum ada anggota</span>
                            @endforelse
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('admin.projects.show', $project) }}"
                            class="inline-block px-4 py-2 bg-[#38d4ae] text-[#18181b] rounded hover:bg-[#2bbd99] transition">Detail</a>
                        <a href="{{ route('admin.projects.edit', $project) }}"
                            class="inline-block px-4 py-2 bg-[#232329] border border-[#38d4ae] text-[#38d4ae] rounded hover:bg-[#38d4ae] hover:text-[#18181b] transition">Edit</a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center text-gray-400">Belum ada proyek.</div>
            @endforelse
        </div>
        <div class="mt-6">
            {{ $projects->withQueryString()->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
