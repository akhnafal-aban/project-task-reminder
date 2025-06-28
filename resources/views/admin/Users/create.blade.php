@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-[#232329] rounded-lg shadow p-8">
        <h2 class="text-2xl font-bold text-[#38d4ae] mb-8">Add User</h2>
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-semibold text-[#f3f4f6] mb-1">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-[#18181b] text-[#f3f4f6] border @error('name') border-red-500 @else border-[#38383f] @enderror rounded px-3 py-2 focus:ring-2 focus:ring-[#38d4ae]" required />
                @error('name')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-5">
                <label class="block text-sm font-semibold text-[#f3f4f6] mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-[#18181b] text-[#f3f4f6] border @error('email') border-red-500 @else border-[#38383f] @enderror rounded px-3 py-2 focus:ring-2 focus:ring-[#38d4ae]" required />
                @error('email')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-5">
                <label class="block text-sm font-semibold text-[#f3f4f6] mb-1">Role <span class="text-red-500">*</span></label>
                <select name="role" class="w-full bg-[#18181b] text-[#f3f4f6] border @error('role') border-red-500 @else border-[#38383f] @enderror rounded px-3 py-2 focus:ring-2 focus:ring-[#38d4ae]" required>
                    <option value="">Select Role</option>
                    @foreach(\App\Enums\UserRole::cases() as $role)
                        <option value="{{ $role->value }}" @selected(old('role') == $role->value)>{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-5">
                <label class="block text-sm font-semibold text-[#f3f4f6] mb-1">Password <span class="text-red-500">*</span></label>
                <input type="password" name="password" class="w-full bg-[#18181b] text-[#f3f4f6] border @error('password') border-red-500 @else border-[#38383f] @enderror rounded px-3 py-2 focus:ring-2 focus:ring-[#38d4ae]" required />
                @error('password')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-8">
                <label class="block text-sm font-semibold text-[#f3f4f6] mb-1">Confirm Password <span class="text-red-500">*</span></label>
                <input type="password" name="password_confirmation" class="w-full bg-[#18181b] text-[#f3f4f6] border @error('password_confirmation') border-red-500 @else border-[#38383f] @enderror rounded px-3 py-2 focus:ring-2 focus:ring-[#38d4ae]" required />
                @error('password_confirmation')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded bg-[#38383f] text-[#f3f4f6] hover:bg-[#2b2b2f] transition">Cancel</a>
                <button type="submit" class="px-4 py-2 rounded bg-[#38d4ae] text-[#18181b] font-semibold hover:bg-[#2bbd99] transition">Add User</button>
            </div>
        </form>
    </div>
</div>
@endsection
