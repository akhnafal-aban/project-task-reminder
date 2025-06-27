<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;

class UserController extends Controller
{
    public function index(): View
    {
        $query = User::query();

        // Filter & search
        $search = request('search');
        $role = request('role');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%") ;
            });
        }
        if ($role && $role !== 'all') {
            $query->where('role', $role);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        // Ambil daftar role unik untuk dropdown
        $roles = collect(UserRole::cases() ?? [])->pluck('name');

        return view('admin.users.index', compact('users', 'roles', 'search', 'role'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dibuat.');
    }

    public function show(User $user): View
    {
        // Ambil proyek yang dibuat user dan proyek yang diikuti user (assigned)
        $createdProjects = $user->createdProjects()->with('tasks')->get();
        $assignedProjects = $user->assignedProjects()->with('tasks')->get();
        // Gabungkan dan hilangkan duplikat berdasarkan id
        $projects = $createdProjects->merge($assignedProjects)->unique('id');

        $tasks = $user->tasks()->get();
        $highPriorityTasks = $tasks->where('priority', 'high');
        $mediumPriorityTasks = $tasks->where('priority', 'medium');
        $lowPriorityTasks = $tasks->where('priority', 'low');

        return view('admin.users.show', compact(
            'user',
            'projects',
            'highPriorityTasks',
            'mediumPriorityTasks',
            'lowPriorityTasks'
        ));
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
        $user->update($validated);
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
