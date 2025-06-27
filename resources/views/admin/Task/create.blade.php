@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-[#232329] rounded-lg shadow p-8 mt-8">
    <h2 class="text-2xl font-bold text-[#38d4ae] mb-8">Tambah Tugas</h2>
    <form method="POST" action="{{ route('admin.tasks.store') }}" onsubmit="return validateTaskForm(this)">
        @csrf
        <div class="mb-5">
            <label class="block text-sm font-semibold text-[#f3f4f6] mb-1">Judul Tugas <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full bg-[#18181b] text-[#f3f4f6] border @error('title') border-red-500 @else border-[#38383f] @enderror rounded px-3 py-2 focus:ring-2 focus:ring-[#38d4ae]" required />
            @error('title')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-5">
            <label class="block text-sm font-semibold text-[#f3f4f6] mb-1">Proyek <span class="text-red-500">*</span></label>
            <input type="search" placeholder="Cari proyek..." class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2 mb-2" oninput="filterSelectOptions(this, 'project_id')">
            <select name="project_id" id="project_id" class="w-full bg-[#18181b] text-[#f3f4f6] border @error('project_id') border-red-500 @else border-[#38383f] @enderror rounded px-3 py-2" required>
                <option value="">Pilih Proyek</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>{{ $project->name }}</option>
                @endforeach
            </select>
            @error('project_id')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-5">
            <label class="block text-sm font-semibold text-[#f3f4f6] mb-1">Ditugaskan ke</label>
            <input type="search" placeholder="Cari user..." class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2 mb-2" oninput="filterSelectOptions(this, 'assigned_to')">
            <select name="assigned_to" id="assigned_to" class="w-full bg-[#18181b] text-[#f3f4f6] border @error('assigned_to') border-red-500 @else border-[#38383f] @enderror rounded px-3 py-2">
                <option value="">Pilih User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @selected(old('assigned_to') == $user->id)>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('assigned_to')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-5">
            <label class="block text-sm font-semibold text-[#f3f4f6] mb-1">Prioritas <span class="text-red-500">*</span></label>
            <select name="priority" class="w-full bg-[#18181b] text-[#f3f4f6] border @error('priority') border-red-500 @else border-[#38383f] @enderror rounded px-3 py-2" required>
                @foreach(\App\Enums\TaskPriority::cases() as $priority)
                    <option value="{{ $priority->value }}" @selected(old('priority') == $priority->value)>{{ $priority->name }}</option>
                @endforeach
            </select>
            @error('priority')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-5">
            <label class="block text-sm font-semibold text-[#f3f4f6] mb-1">Jatuh Tempo <span class="text-red-500">*</span></label>
            <input type="date" name="due_date" value="{{ old('due_date') }}" class="w-full bg-[#18181b] text-[#f3f4f6] @error('due_date') border-red-500 @else border-[#38383f] @enderror border rounded px-3 py-2" required />
            @error('due_date')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-8">
            <label class="block text-sm font-semibold text-[#f3f4f6] mb-1">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="description" rows="3" class="w-full bg-[#18181b] text-[#f3f4f6] @error('description') border-red-500 @else border-[#38383f] @enderror border rounded px-3 py-2" required>{{ old('description') }}</textarea>
            @error('description')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.tasks.index') }}" class="px-4 py-2 rounded bg-[#38383f] text-[#f3f4f6] hover:bg-[#2b2b2f] transition">Batal</a>
            <button type="submit" class="px-4 py-2 rounded bg-[#38d4ae] text-[#18181b] font-semibold hover:bg-[#2bbd99] transition">Simpan</button>
        </div>
    </form>
</div>
<script>
function filterSelectOptions(input, selectId) {
    const filter = input.value.toLowerCase();
    const select = document.getElementById(selectId);
    for (let i = 0; i < select.options.length; i++) {
        const option = select.options[i];
        if (i === 0) { option.style.display = ''; continue; }
        option.style.display = option.text.toLowerCase().includes(filter) ? '' : 'none';
    }
}

function validateTaskForm(form) {
    let valid = true;
    let fields = [
        { name: 'title', label: 'Judul Tugas' },
        { name: 'project_id', label: 'Proyek' },
        { name: 'assigned_to', label: 'Ditugaskan ke' },
        { name: 'priority', label: 'Prioritas' },
        { name: 'due_date', label: 'Jatuh Tempo' },
        { name: 'description', label: 'Deskripsi' },
    ];
    let firstInvalid = null;
    fields.forEach(f => {
        let el = form.elements[f.name];
        if (el && !el.value) {
            valid = false;
            el.classList.add('border-red-500');
            if (!firstInvalid) firstInvalid = el;
        } else if (el) {
            el.classList.remove('border-red-500');
        }
    });
    if (!valid) {
        alert('Semua kolom wajib diisi!');
        if (firstInvalid) firstInvalid.focus();
    }
    return valid;
}
</script>
@endsection
