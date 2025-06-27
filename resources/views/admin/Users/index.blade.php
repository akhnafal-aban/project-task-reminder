@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap md:flex-nowrap items-end justify-between gap-4 mb-6">
        <h2 class="text-xl font-bold text-[#38d4ae]">Users</h2>
        <div class="flex-0 ml-auto">
            <a href="{{ route('admin.users.create') }}" class="bg-[#38d4ae] text-[#18181b] px-4 py-2 rounded hover:bg-[#2bbd99] transition font-semibold whitespace-nowrap">+ User</a>
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
