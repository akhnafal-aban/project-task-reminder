@extends('layouts.app')

@section('title', 'Tambah Tugas Proyek')

@section('content')
<div class="max-w-xl mx-auto bg-[#232329] rounded-lg shadow p-8 mt-8">
    <h1 class="text-2xl font-bold mb-8 text-[#38d4ae]">Tambah Tugas Proyek</h1>
    @if($errors->any())
        <div class="mb-6 p-4 rounded bg-[#e5484d] text-white">
            <ul class="mb-0 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.projects.tasks.store', $project) }}">
        @csrf
        <div class="mb-5">
            <label for="name" class="block mb-1 font-semibold text-[#f3f4f6]">Nama Tugas <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" class="w-full px-3 py-2 rounded border bg-[#18181b] text-[#f3f4f6] focus:ring-2 focus:ring-[#38d4ae] @error('name') border-red-500 @else border-[#38383f] @enderror" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="description" class="block mb-1 font-semibold text-[#f3f4f6]">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="description" id="description" class="w-full px-3 py-2 rounded border bg-[#18181b] text-[#f3f4f6] focus:ring-2 focus:ring-[#38d4ae] @error('description') border-red-500 @else border-[#38383f] @enderror" rows="3" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="assigned_to" class="block mb-1 font-semibold text-[#f3f4f6]">Anggota <span class="text-red-500">*</span></label>
            <select name="assigned_to" id="assigned_to" class="w-full px-3 py-2 rounded border bg-[#18181b] text-[#f3f4f6] focus:ring-2 focus:ring-[#38d4ae] @error('assigned_to') border-red-500 @else border-[#38383f] @enderror" required>
                <option value="">Pilih anggota</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}" {{ old('assigned_to') == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                @endforeach
            </select>
            @error('assigned_to')
                <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="priority" class="block mb-1 font-semibold text-[#f3f4f6]">Prioritas <span class="text-red-500">*</span></label>
            <select name="priority" id="priority" class="w-full px-3 py-2 rounded border bg-[#18181b] text-[#f3f4f6] focus:ring-2 focus:ring-[#38d4ae] @error('priority') border-red-500 @else border-[#38383f] @enderror" required>
                <option value="">Pilih prioritas</option>
                @foreach(\App\Enums\TaskPriority::cases() as $priority)
                    <option value="{{ $priority->value }}" {{ old('priority') == $priority->value ? 'selected' : '' }}>{{ $priority->label() }}</option>
                @endforeach
            </select>
            @error('priority')
                <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-8">
            <label for="due_date" class="block mb-1 font-semibold text-[#f3f4f6]">Batas Waktu <span class="text-red-500">*</span></label>
            <input type="date" name="due_date" id="due_date" class="w-full px-3 py-2 rounded border bg-[#18181b] text-[#f3f4f6] focus:ring-2 focus:ring-[#38d4ae] @error('due_date') border-red-500 @else border-[#38383f] @enderror" value="{{ old('due_date') }}" required>
            @error('due_date')
                <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.projects.show', $project) }}" class="px-4 py-2 rounded bg-[#38383f] text-[#f3f4f6] hover:bg-[#2b2b2f] transition">Batal</a>
            <button type="submit" class="px-4 py-2 rounded bg-[#38d4ae] text-[#18181b] font-semibold hover:bg-[#2bbd99] transition">Simpan</button>
        </div>
    </form>
</div>
@endsection
