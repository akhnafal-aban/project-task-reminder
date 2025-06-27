@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-1xl mx-auto bg-[#232329] rounded-lg shadow p-6 mb-8">
        <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-2">
            <div>
                <h2 class="text-2xl font-bold text-[#38d4ae] mb-1">{{ $task->title }}</h2>
                <div class="flex flex-wrap gap-2 text-sm text-[#b3b3b3] mb-1">
                    <span><strong>Project:</strong> {{ $task->project->name ?? '-' }}</span>
                    <span><strong>Assignee:</strong> {{ $task->assignedUser->name ?? '-' }}</span>
                    <span><strong>Due:</strong> {{ $task->due_date ? $task->due_date->format('Y-m-d') : '-' }}</span>
                </div>
                <div class="flex flex-wrap gap-2 mb-2">
                    <span class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $task->priority->value === 'high' ? 'bg-red-500 text-white' : ($task->priority->value === 'medium' ? 'bg-yellow-500 text-black' : 'bg-green-500 text-black') }}">
                        {{ $task->priority->name }}
                    </span>
                    <span class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $task->status->value === 'completed' ? 'bg-green-600 text-white' : ($task->status->value === 'in_progress' ? 'bg-blue-500 text-white' : 'bg-gray-500 text-white') }}">
                        {{ $task->status->name }}
                    </span>
                </div>
            </div>
            <div class="flex gap-2 mt-2 md:mt-0">
                <a href="{{ route('admin.tasks.edit', $task) }}" class="text-[#f3f4f6] hover:text-[#38d4ae] font-medium">Edit</a>
                <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-[#e5484d] hover:text-[#f87171] font-medium ml-2">Delete</button>
                </form>
            </div>
        </div>
        @if($task->description)
            <div class="text-[#f3f4f6] mb-2">{{ $task->description }}</div>
        @endif
    </div>
    <div class="max-w-1xl mx-auto bg-[#232329] rounded-lg shadow p-6">
        <p class="text-[#929292]"">Still on Develop</p>
        <h3 id="comments" class="text-lg font-semibold text-[#38d4ae] mb-4">Comments ({{ $comments->count() }})</h3>
        {{-- Debug: uncomment to see raw comments data --}}
        {{-- <pre class="text-xs text-[#b3b3b3]">{{ var_export($comments, true) }}</pre> --}}
        <form method="POST" action="{{ route('admin.tasks.comment', $task) }}" class="mb-6">
            @csrf
            <div class="mb-2">
                <textarea name="comment" rows="2" class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" placeholder="Add a comment..." required>{{ old('comment') }}</textarea>
                @error('comment')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex justify-between items-center mb-2">
                <div class="text-xs text-[#b3b3b3]">Logged in as: <span class="text-[#38d4ae]">{{ auth()->user()->name ?? 'GUEST' }}</span></div>
                <button type="submit" class="bg-[#38d4ae] text-[#18181b] px-4 py-2 rounded hover:bg-[#2bbd99] transition font-semibold">Post Comment</button>
            </div>
        </form>
        <div class="space-y-4">
            @forelse($comments as $comment)
                <div class="bg-[#18181b] rounded p-4 border border-[#26272b]">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-[#38d4ae] font-semibold">{{ $comment->user->name ?? 'Unknown' }} (user_id: {{ $comment->user_id }})</span>
                        <span class="text-[#b3b3b3] text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="text-[#f3f4f6] text-sm">{{ $comment->comment }}</div>
                </div>
            @empty
                <div class="text-[#b3b3b3] italic">No comments yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
