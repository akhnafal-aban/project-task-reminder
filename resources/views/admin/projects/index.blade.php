@extends('layouts.app')

@section('title', 'Manajemen Proyek')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Daftar Proyek</h1>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">+ Tambah Proyek</a>
</div>
@if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif
<div class="overflow-x-auto rounded shadow" style="background:#232329;">
    <table class="min-w-full table-auto text-left text-sm" style="color:#f3f4f6;">
        <thead style="background:#18181b; color:#6b6b6b;">
            <tr>
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
                <tr class="border-b" style="border-color:#26272b;">
                    <td class="px-4 py-2">{{ $project->name }}</td>
                    <td class="px-4 py-2">{{ $project->description }}</td>
                    <td class="px-4 py-2">{{ $project->start_date->format('d M Y') }}</td>
                    <td class="px-4 py-2">{{ $project->end_date->format('d M Y') }}</td>
                    <td class="px-4 py-2">
                        @if($project->isActive())
                            <span class="font-bold" style="color:#38d4ae;">Aktif</span>
                        @elseif($project->isUpcoming())
                            <span class="font-bold" style="color:#facc15;">Akan Datang</span>
                        @else
                            <span class="font-bold" style="color:#a1a1aa;">Selesai</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Yakin hapus proyek ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="color:#ff4e4e;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4" style="color:#a1a1aa;">Belum ada proyek.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $projects->links() }}
</div>
@endsection
