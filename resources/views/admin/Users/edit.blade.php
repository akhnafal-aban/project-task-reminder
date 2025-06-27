@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-[#232329] rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-[#f3f4f6] mb-6">Edit User</h2>
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm text-[#b3b3b3] mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" required />
                @error('name')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm text-[#b3b3b3] mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" required />
                @error('email')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm text-[#b3b3b3] mb-1">Role</label>
                <select name="role" class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" required>
                    <option value="">Select Role</option>
                    @foreach(\App\Enums\UserRole::cases() as $role)
                        <option value="{{ $role->value }}" @selected(old('role', $user->role->value ?? $user->role) == $role->value)>{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm text-[#b3b3b3] mb-1">Password <span class="text-xs text-[#b3b3b3]">(leave blank to keep current)</span></label>
                <input type="password" name="password" class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" />
                @error('password')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm text-[#b3b3b3] mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2" />
                @error('password_confirmation')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex justify-end">
                <a href="{{ route('admin.users.index') }}" class="mr-4 text-[#b3b3b3] hover:text-[#38d4ae]">Cancel</a>
                <button type="submit" class="bg-[#38d4ae] text-[#18181b] px-4 py-2 rounded hover:bg-[#2bbd99] transition font-semibold">Update User</button>
            </div>
        </form>
    </div>
</div>
@endsection
