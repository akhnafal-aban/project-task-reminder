@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-[#232329] rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-[#f3f4f6] mb-6">Create Task</h2>
        <form method="POST" action="{{ route('admin.tasks.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm text-[#b3b3b3] mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#38d4ae]" required />
                @error('title')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm text-[#b3b3b3] mb-1">Project</label>
                <input type="search" placeholder="Search project..." class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2 mb-2" oninput="filterSelectOptions(this, 'project_id')">
                <select name="project_id" id="project_id" class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" required>
                    <option value="">Select Project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>{{ $project->name }}</option>
                    @endforeach
                </select>
                @error('project_id')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm text-[#b3b3b3] mb-1">Assignee</label>
                <input type="search" placeholder="Search user..." class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2 mb-2" oninput="filterSelectOptions(this, 'assigned_to')">
                <select name="assigned_to" id="assigned_to" class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2">
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @selected(old('assigned_to') == $user->id)>{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('assigned_to')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm text-[#b3b3b3] mb-1">Priority</label>
                <select name="priority" class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" required>
                    @foreach(\App\Enums\TaskPriority::cases() as $priority)
                        <option value="{{ $priority->value }}" @selected(old('priority') == $priority->value)>{{ $priority->name }}</option>
                    @endforeach
                </select>
                @error('priority')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm text-[#b3b3b3] mb-1">Status</label>
                <select name="status" class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" required>
                    @foreach(\App\Enums\TaskStatus::cases() as $status)
                        <option value="{{ $status->value }}" @selected(old('status') == $status->value)>{{ $status->name }}</option>
                    @endforeach
                </select>
                @error('status')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm text-[#b3b3b3] mb-1">Due Date</label>
                <input type="date" name="due_date" value="{{ old('due_date') }}" class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" />
                @error('due_date')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-6">
                <label class="block text-sm text-[#b3b3b3] mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2">{{ old('description') }}</textarea>
                @error('description')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex justify-end">
                <a href="{{ route('admin.tasks.index') }}" class="mr-4 text-[#b3b3b3] hover:text-[#38d4ae]">Cancel</a>
                <button type="submit" class="bg-[#38d4ae] text-[#18181b] px-4 py-2 rounded hover:bg-[#2bbd99] transition font-semibold">Create Task</button>
            </div>
        </form>
    </div>
</div>
<script>
function filterSelectOptions(input, selectId) {
    const filter = input.value.toLowerCase();
    const select = document.getElementById(selectId);
    for (let i = 0; i < select.options.length; i++) {
        const option = select.options[i];
        if (i === 0) { option.style.display = ''; continue; } // always show placeholder
        option.style.display = option.text.toLowerCase().includes(filter) ? '' : 'none';
    }
}
</script>
@endsection
