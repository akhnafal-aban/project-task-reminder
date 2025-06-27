@extends('layouts.app')

@section('title', 'Manajemen Proyek')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap md:flex-nowrap items-end justify-between gap-4 mb-6">
        <form method="GET" class="flex flex-wrap gap-4 items-end flex-1" id="project-filter-form">
            <div>
                <label for="search" class="block text-sm text-[#b3b3b3] mb-1">Cari Nama/ID</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari proyek..." class="bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#38d4ae]" onchange="this.form.submit()">
            </div>
            <div>
                <label for="status" class="block text-sm text-[#b3b3b3] mb-1">Status</label>
                <select name="status" id="status" class="bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="active" @if(request('status')==='active') selected @endif>Aktif</option>
                    <option value="upcoming" @if(request('status')==='upcoming') selected @endif>Akan Datang</option>
                    <option value="finished" @if(request('status')==='finished') selected @endif>Selesai</option>
                </select>
            </div>
            <div>
                <label for="sort" class="block text-sm text-[#b3b3b3] mb-1">Urutkan</label>
                <select name="sort" id="sort" class="bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="id" @if(request('sort')==='id') selected @endif>ID</option>
                    <option value="name" @if(request('sort')==='name') selected @endif>Nama</option>
                    <option value="start_date" @if(request('sort')==='start_date') selected @endif>Tanggal Mulai</option>
                    <option value="end_date" @if(request('sort')==='end_date') selected @endif>Tanggal Selesai</option>
                </select>
            </div>
            <div>
                <label for="direction" class="block text-sm text-[#b3b3b3] mb-1">Arah</label>
                <select name="direction" id="direction" class="bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="asc" @if(request('direction')==='asc') selected @endif>Naik</option>
                    <option value="desc" @if(request('direction')==='desc') selected @endif>Turun</option>
                </select>
            </div>
        </form>
        <div class="flex-0 ml-auto">
            <a href="{{ route('admin.projects.create') }}" class="bg-[#38d4ae] text-[#18181b] px-4 py-2 rounded hover:bg-[#2bbd99] transition font-semibold whitespace-nowrap">+ Tambah Proyek</a>
        </div>
    </div>
    @if(session('success'))
        <div class="bg-green-700 text-green-100 rounded px-4 py-2 mb-4">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full bg-[#232329] rounded-lg">
            <thead>
                <tr class="text-[#b3b3b3] text-left">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Deskripsi</th>
                    <th class="px-4 py-2">Tanggal Mulai</th>
                    <th class="px-4 py-2">Tanggal Selesai</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr class="border-b border-[#38383f] hover:bg-[#18181b] transition">
                        <td class="px-4 py-2 text-[#f3f4f6]">{{ $project->id }}</td>
                        <td class="px-4 py-2 text-[#f3f4f6]">{{ $project->name }}</td>
                        <td class="px-4 py-2 text-[#b3b3b3]">{{ $project->description }}</td>
                        <td class="px-4 py-2 text-[#b3b3b3]">{{ $project->start_date->format('d M Y') }}</td>
                        <td class="px-4 py-2 text-[#b3b3b3]">{{ $project->end_date->format('d M Y') }}</td>
                        <td class="px-4 py-2">
                            @if($project->isActive())
                                <span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-[#38d4ae] text-[#18181b]">Aktif</span>
                            @elseif($project->isUpcoming())
                                <span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-yellow-400 text-[#18181b]">Akan Datang</span>
                            @else
                                <span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-500 text-white">Selesai</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('admin.projects.show', $project) }}" class="text-[#38d4ae] hover:underline">Detail</a>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="text-[#f3f4f6] hover:text-[#38d4ae]">Edit</a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Yakin hapus proyek ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-[#b3b3b3]">Belum ada proyek.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $projects->withQueryString()->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection
