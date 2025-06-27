@extends('layouts.app')

@section('title', 'Tambah Proyek')

@section('content')
<div class="max-w-xl mx-auto bg-[#232329] rounded-lg shadow p-8 mt-8">
    <h1 class="text-2xl font-bold mb-8 text-[#38d4ae]">Tambah Proyek Baru</h1>
    @if($errors->any())
        <div class="mb-6 p-4 rounded bg-[#e5484d] text-white">
            <ul class="mb-0 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="mb-6 p-4 rounded flex items-center gap-2 bg-green-900/30 border border-green-500 text-green-300">
            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.projects.store') }}">
        @csrf
        <div class="mb-5">
            <label for="name" class="block mb-1 font-semibold text-[#f3f4f6]">Nama Proyek <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" class="w-full px-3 py-2 rounded border border-[#38383f] bg-[#18181b] text-[#f3f4f6] focus:ring-2 focus:ring-[#38d4ae] @error('name') border-red-500 @enderror" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="description" class="block mb-1 font-semibold text-[#f3f4f6]">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="description" id="description" class="w-full px-3 py-2 rounded border border-[#38383f] bg-[#18181b] text-[#f3f4f6] focus:ring-2 focus:ring-[#38d4ae] @error('description') border-red-500 @enderror" rows="3" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="start_date" class="block mb-1 font-semibold text-[#f3f4f6]">Tanggal Mulai <span class="text-red-500">*</span></label>
            <input type="date" name="start_date" id="start_date" class="w-full px-3 py-2 rounded border border-[#38383f] bg-[#18181b] text-[#f3f4f6] focus:ring-2 focus:ring-[#38d4ae] @error('start_date') border-red-500 @enderror" value="{{ old('start_date') }}" required>
            @error('start_date')
                <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-8">
            <label for="end_date" class="block mb-1 font-semibold text-[#f3f4f6]">Tanggal Selesai <span class="text-red-500">*</span></label>
            <input type="date" name="end_date" id="end_date" class="w-full px-3 py-2 rounded border border-[#38383f] bg-[#18181b] text-[#f3f4f6] focus:ring-2 focus:ring-[#38d4ae] @error('end_date') border-red-500 @enderror" value="{{ old('end_date') }}" required>
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
