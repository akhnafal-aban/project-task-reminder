@extends('layouts.app')

@section('title', 'ProyekKu')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-[#38d4ae]">Daftar Proyek Saya</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($projects as $project)
            <div class="bg-[#232329] rounded-lg p-6 shadow border border-[#38383f]">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-xl font-semibold text-[#f3f4f6]">{{ $project->name }}</h2>
                    <span class="text-xs text-gray-400">#{{ $project->id }}</span>
                </div>
                <div class="text-gray-300 mb-2">{{ $project->description }}</div>
                <div class="text-sm text-gray-400 mb-2">Dibuat oleh: <span class="text-[#38d4ae]">{{ $project->createdBy->name ?? '-' }}</span></div>
                <div class="flex flex-wrap gap-2 mb-2">
                    <span class="font-semibold text-xs text-gray-400">Anggota:</span>
                    @foreach($project->members as $member)
                        <span class="px-2 py-1 rounded text-xs border border-[#38d4ae] text-[#38d4ae]">{{ $member->name }}</span>
                    @endforeach
                </div>
                <a href="{{ route('member.projects.show', $project) }}" class="inline-block mt-2 px-4 py-2 bg-[#38d4ae] text-[#18181b] rounded hover:bg-[#2bbd99] transition">Detail</a>
            </div>
        @empty
            <div class="col-span-2 text-center text-gray-400">Belum ada proyek yang diikuti.</div>
        @endforelse
    </div>
</div>
@endsection
