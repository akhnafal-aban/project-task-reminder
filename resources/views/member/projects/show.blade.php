@extends('layouts.app')

@section('title', 'Detail Proyek')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-[#232329] rounded-lg p-6 shadow border border-[#38383f] mb-6">
        <h1 class="text-2xl font-bold text-[#38d4ae] mb-2">{{ $project->name }}</h1>
        <div class="text-gray-300 mb-2">{{ $project->description }}</div>
        <div class="text-sm text-gray-400 mb-2">Dibuat oleh: <span class="text-[#38d4ae]">{{ $project->createdBy->name ?? '-' }}</span></div>
        <div class="flex flex-wrap gap-2 mb-2">
            <span class="font-semibold text-xs text-gray-400">Anggota:</span>
            @foreach($project->tasks->pluck('assignedUser')->unique('id') as $member)
                @if($member)
                    <span class="px-2 py-1 rounded text-xs border border-[#38d4ae] text-[#38d4ae]">{{ $member->name }}</span>
                @endif
            @endforeach
        </div>
        <a href="{{ route('member.tasks.index') }}" class="inline-block mt-2 px-4 py-2 bg-[#38d4ae] text-[#18181b] rounded hover:bg-[#2bbd99] transition">Lihat Tugas Saya</a>
    </div>
</div>
@endsection
