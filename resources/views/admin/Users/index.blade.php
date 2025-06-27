@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap gap-4 items-end flex-1" id="user-filter-form">
            <div>
                <label for="search" class="block text-sm text-[#b3b3b3] mb-1">Cari Nama/Email</label>
                <input type="text" name="search" id="search" value="{{ $search ?? request('search') }}" placeholder="Cari user..." class="bg-[#18181b] text-[#f3f4f6] border border-[#38383f] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#38d4ae]" onchange="this.form.submit()">
            </div>
            <div>
                <label for="role" class="block text-sm text-[#b3b3b3] mb-1">Role</label>
                <select name="role" id="role" class="bg-[#18181b] text-[#b3b3b3] border border-[#38383f] rounded px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-[#38d4ae]" style="background-position:right 0.75rem center;" onchange="this.form.submit()">
                    <option value="all" @if(($role ?? request('role') ?? 'all') === 'all') selected @endif>Semua</option>
                    @foreach($roles as $r)
                        <option value="{{ $r }}" @if(($role ?? request('role')) === $r) selected @endif>{{ ucfirst($r) }}</option>
                    @endforeach
                </select>
            </div>
        </form>
        <div class="flex md:ml-4 mt-4 md:mt-0">
            <a href="{{ route('admin.users.create') }}" class="bg-[#38d4ae] text-[#18181b] px-4 py-2 rounded hover:bg-[#2bbd99] transition font-semibold whitespace-nowrap w-full md:w-auto text-center">+ Tambah User</a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-[#232329] rounded-lg">
            <thead>
                <tr class="text-[#b3b3b3] text-left">
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2">Created</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b border-[#38383f] hover:bg-[#18181b] transition">
                        <td class="px-4 py-2 text-[#f3f4f6]">{{ $user->name }}</td>
                        <td class="px-4 py-2 text-[#b3b3b3]">{{ $user->email }}</td>
                        <td class="px-4 py-2 text-[#b3b3b3]">{{ $user->role->name ?? '-' }}</td>
                        <td class="px-4 py-2 text-[#b3b3b3]">{{ $user->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.users.show', $user) }}" class="text-[#38d4ae] hover:underline mr-2">View</a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-[#f3f4f6] hover:text-[#38d4ae] mr-2">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[#e5484d] hover:text-[#f87171] font-medium ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-[#b3b3b3]">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $users->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection
