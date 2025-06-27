@extends('layouts.app')

@section('content')
<main class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Tambah Tugas ke Proyek: <span style="color:#38d4ae;">{{ $project->name }}</span></h1>
    <form action="{{ route('admin.projects.tasks.store', $project) }}" method="POST" class="max-w-xl mx-auto p-6 rounded shadow" style="border:1px solid #26272b;">
        @csrf
        <div class="mb-4">
            <label for="title" class="block mb-1 font-semibold">Judul Tugas</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full px-3 py-2 rounded border border-gray-700 bg-transparent" style="color:#f3f4f6;">
            @error('title')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label for="description" class="block mb-1 font-semibold">Deskripsi</label>
            <textarea name="description" id="description" rows="3" class="w-full px-3 py-2 rounded border border-gray-700 bg-transparent" style="color:#f3f4f6;">{{ old('description') }}</textarea>
            @error('description')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label for="due_date" class="block mb-1 font-semibold">Jatuh Tempo</label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" class="w-full px-3 py-2 rounded border border-gray-700 bg-transparent" style="color:#f3f4f6;">
            @error('due_date')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label for="priority" class="block mb-1 font-semibold">Prioritas</label>
            <select name="priority" id="priority" class="w-full px-3 py-2 rounded border border-gray-700 bg-transparent" style="color:#f3f4f6;">
                <option value="">Pilih Prioritas</option>
                <option value="low" @if(old('priority')==='low') selected @endif>Rendah</option>
                <option value="medium" @if(old('priority')==='medium') selected @endif>Sedang</option>
                <option value="high" @if(old('priority')==='high') selected @endif>Tinggi</option>
            </select>
            @error('priority')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-6">
            <label for="assigned_to" class="block mb-1 font-semibold">Ditugaskan ke</label>
            <select name="assigned_to" id="assigned_to" class="w-full px-3 py-2 rounded border border-gray-700 bg-transparent" style="color:#f3f4f6;">
                <option value="">Pilih Anggota</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}" @if(old('assigned_to')==$member->id) selected @endif>{{ $member->name }}</option>
                @endforeach
            </select>
            @error('assigned_to')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="btn">Simpan Tugas</button>
        </div>
    </form>
</main>
@endsection
