@extends('layouts.app')

@section('title', 'Tambah Proyek')

@section('content')
<div class="max-w-lg mx-auto rounded shadow p-6" style="background:#232329;">
    <h1 class="text-2xl font-bold mb-6" style="color:#38d4ae;">Tambah Proyek Baru</h1>
    @if($errors->any())
        <div class="alert alert-danger mb-4 rounded p-3" style="background:#e5484d; color:#fff;">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="mb-4 p-3 rounded text-green-900 bg-green-200 border border-green-400 flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.projects.store') }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="block mb-1 font-semibold" style="color:#f3f4f6;">Nama Proyek <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" class="form-control border rounded w-full px-3 py-2 @error('name') border-red-500 @enderror" style="background:#18181b; color:#f3f4f6; border-color:#26272b;" value="{{ old('name') }}" required autofocus>
            @error('name')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description" class="block mb-1 font-semibold" style="color:#f3f4f6;">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="description" id="description" class="form-control border rounded w-full px-3 py-2 @error('description') border-red-500 @enderror" style="background:#18181b; color:#f3f4f6; border-color:#26272b;" rows="3" required>{{ old('description') }}</textarea>
            @error('description')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="start_date" class="block mb-1 font-semibold" style="color:#f3f4f6;">Tanggal Mulai <span class="text-red-500">*</span></label>
            <input type="date" name="start_date" id="start_date" class="form-control border rounded w-full px-3 py-2 @error('start_date') border-red-500 @enderror" style="background:#18181b; color:#f3f4f6; border-color:#26272b;" value="{{ old('start_date') }}" required>
            @error('start_date')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="end_date" class="block mb-1 font-semibold" style="color:#f3f4f6;">Tanggal Selesai <span class="text-red-500">*</span></label>
            <input type="date" name="end_date" id="end_date" class="form-control border rounded w-full px-3 py-2 @error('end_date') border-red-500 @enderror" style="background:#18181b; color:#f3f4f6; border-color:#26272b;" value="{{ old('end_date') }}" required>
            @error('end_date')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
