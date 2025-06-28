@extends('layouts.app')

@section('title', 'ProyekKu')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-[#38d4ae]">Daftar Proyek Saya</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($projects as $project)
            <div class="bg-[#232329] rounded-lg p-6 shadow border border-[#38383f] flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-xl font-semibold text-[#f3f4f6]">{{ $project->name }}</h2>
                        <span class="text-xs text-gray-400">#{{ $project->id }}</span>
                    </div>
                    <div class="text-gray-300 mb-2">{{ $project->description }}</div>
                    <div class="flex items-center gap-2 text-sm text-gray-400 mb-2">
                        <svg class="w-4 h-4 text-[#38d4ae]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="12" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Dibuat oleh:</span>
                        <span class="text-[#38d4ae] font-semibold ml-1">{{ $project->createdBy->name ?? '-' }}</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-2 items-center">
                        <span class="font-semibold text-xs text-gray-400 flex items-center gap-1">
                            <svg class="w-4 h-4 text-[#38d4ae]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 0 0-3-3.87" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 21v-2a4 4 0 0 1 3-3.87" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="12" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Anggota:
                        </span>
                        @php $members = $project->tasks->pluck('assignedUser')->unique('id')->filter(); @endphp
                        @forelse($members as $member)
                            <span class="flex items-center gap-1 px-2 py-1 rounded text-xs border border-[#38d4ae] text-[#38d4ae] bg-[#18181b] font-medium">
                                <svg class="w-3 h-3 text-[#38d4ae]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                                {{ $member->name }}
                            </span>
                        @empty
                            <span class="italic text-gray-500">Belum ada anggota</span>
                        @endforelse
                    </div>
                </div>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('member.projects.show', $project) }}" class="inline-block px-4 py-2 bg-[#38d4ae] text-[#18181b] rounded hover:bg-[#2bbd99] transition">Detail</a>
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center text-gray-400">Belum ada proyek yang diikuti.</div>
        @endforelse
    </div>
</div>
@endsection
