@extends('layouts.app')

@section('title', 'Edit Proyek')

@section('content')
<div class="max-w-xl mx-auto bg-[#232329] rounded-lg shadow p-8 mt-8">
    <h1 class="text-2xl font-bold mb-8 text-[#38d4ae]">Edit Proyek</h1>
    @if($errors->any())
        <div class="mb-6 p-4 rounded bg-[#e5484d] text-white">
            <ul class="mb-0 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.projects.update', $project) }}">
        @csrf
        @method('PUT')
        <div class="mb-5">
            <label for="name" class="block mb-1 font-semibold text-[#f3f4f6]">Nama Proyek <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" class="w-full px-3 py-2 rounded border bg-[#18181b] text-[#f3f4f6] focus:ring-2 focus:ring-[#38d4ae] @error('name') border-red-500 @else border-[#38383f] @enderror" value="{{ old('name', $project->name) }}" required autofocus>
            @error('name')
                <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="description" class="block mb-1 font-semibold text-[#f3f4f6]">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="description" id="description" class="w-full px-3 py-2 rounded border bg-[#18181b] text-[#f3f4f6] focus:ring-2 focus:ring-[#38d4ae] @error('description') border-red-500 @else border-[#38383f] @enderror" rows="3" required>{{ old('description', $project->description) }}</textarea>
            @error('description')
                <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="start_date" class="block mb-1 font-semibold text-[#f3f4f6]">Tanggal Mulai <span class="text-red-500">*</span></label>
            <input type="date" name="start_date" id="start_date" class="w-full px-3 py-2 rounded border bg-[#18181b] text-[#f3f4f6] focus:ring-2 focus:ring-[#38d4ae] @error('start_date') border-red-500 @else border-[#38383f] @enderror" value="{{ old('start_date', $project->start_date->format('Y-m-d')) }}" required>
            @error('start_date')
                <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-8">
            <label for="end_date" class="block mb-1 font-semibold text-[#f3f4f6]">Tanggal Selesai <span class="text-red-500">*</span></label>
            <input type="date" name="end_date" id="end_date" class="w-full px-3 py-2 rounded border bg-[#18181b] text-[#f3f4f6] focus:ring-2 focus:ring-[#38d4ae] @error('end_date') border-red-500 @else border-[#38383f] @enderror" value="{{ old('end_date', $project->end_date->format('Y-m-d')) }}" required>
            @error('end_date')
                <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 rounded bg-[#38383f] text-[#f3f4f6] hover:bg-[#2b2b2f] transition">Batal</a>
            <button type="submit" class="px-4 py-2 rounded bg-[#38d4ae] text-[#18181b] font-semibold hover:bg-[#2bbd99] transition">Simpan</button>
        </div>
    </form>
</div>
@endsection
