@extends('layouts.app')

@section('title', 'Detail Proyek')

@section('content')
    <div class="max-w-lg mx-auto rounded shadow p-6" style="background:#232329;">
        <h1 class="text-2xl font-bold mb-6" style="color:#38d4ae;">Detail Proyek</h1>
        <form method="POST" action="{{ route('admin.projects.update', $project) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block mb-1 font-semibold" style="color:#f3f4f6;">Nama Proyek</label>
                <input type="text" id="name" name="name" class="form-control border rounded w-full px-3 py-2"
                    style="background:#18181b; color:#f3f4f6; border-color:#26272b;"
                    value="{{ old('name', $project->name) }}">
            </div>
            <div class="mb-4">
                <label for="description" class="block mb-1 font-semibold" style="color:#f3f4f6;">Deskripsi</label>
                <textarea id="description" name="description" class="form-control border rounded w-full px-3 py-2"
                    style="background:#18181b; color:#f3f4f6; border-color:#26272b;" rows="3">{{ old('description', $project->description) }}</textarea>
            </div>
            <div class="mb-4">
                <label for="start_date" class="block mb-1 font-semibold" style="color:#f3f4f6;">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" class="form-control border rounded w-full px-3 py-2"
                    style="background:#18181b; color:#f3f4f6; border-color:#26272b;"
                    value="{{ old('start_date', $project->start_date->format('Y-m-d')) }}">
            </div>
            <div class="mb-4">
                <label for="end_date" class="block mb-1 font-semibold" style="color:#f3f4f6;">Tanggal Selesai</label>
                <input type="date" id="end_date" name="end_date" class="form-control border rounded w-full px-3 py-2"
                    style="background:#18181b; color:#f3f4f6; border-color:#26272b;"
                    value="{{ old('end_date', $project->end_date->format('Y-m-d')) }}">
            </div>
            <div class="mb-4">
                <label for="status" class="block mb-1 font-semibold" style="color:#f3f4f6;">Status</label>
                <select id="status" name="status" class="form-control border rounded w-full px-3 py-2"
                    style="background:#18181b; color:#f3f4f6; border-color:#26272b;">
                    <option value="active" @if ($project->isActive()) selected @endif>Aktif</option>
                    <option value="upcoming" @if ($project->isUpcoming()) selected @endif>Akan Datang</option>
                    <option value="completed" @if ($project->isCompleted()) selected @endif>Selesai</option>
                </select>
            </div>
            <div class="flex justify-end gap-2 mt-6">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
