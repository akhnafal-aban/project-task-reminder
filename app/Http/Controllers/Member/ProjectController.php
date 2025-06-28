<?php

declare(strict_types=1);

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

final class ProjectController extends Controller
{
    // Menampilkan daftar proyek yang user ikuti
    public function index(): View
    {
        $user = Auth::user();
        $projects = Project::whereHas('tasks', function ($q) use ($user) {
            $q->where('assigned_to', $user->id);
        })->with(['createdBy', 'members'])->get();
        return view('member.projects.index', [
            'projects' => $projects,
        ]);
    }

    // Menampilkan detail proyek dan anggota proyek
    public function show(Project $project): View
    {
        $project->load(['members', 'createdBy']);
        return view('member.projects.show', [
            'project' => $project,
            'members' => $project->members,
        ]);
    }
}
