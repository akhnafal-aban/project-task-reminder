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
<div class="overflow-x-auto rounded shadow bg-gray-800">
    <table class="min-w-full table-auto text-left text-sm text-gray-300">
        <thead class="bg-gray-900 text-gray-200">
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
                <tr class="border-b border-gray-700">
                    <td class="px-4 py-2">{{ $project->name }}</td>
                    <td class="px-4 py-2">{{ $project->description }}</td>
                    <td class="px-4 py-2">{{ $project->start_date->format('d M Y') }}</td>
                    <td class="px-4 py-2">{{ $project->end_date->format('d M Y') }}</td>
                    <td class="px-4 py-2">
                        @if($project->isActive())
                            <span class="badge bg-green-600">Aktif</span>
                        @elseif($project->isUpcoming())
                            <span class="badge bg-yellow-600">Akan Datang</span>
                        @else
                            <span class="badge bg-gray-500">Selesai</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Yakin hapus proyek ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-400">Belum ada proyek.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $projects->links() }}
</div>
@endsection
