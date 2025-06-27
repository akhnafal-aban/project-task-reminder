<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

final class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();
        $users = User::all();

        foreach ($projects as $project) {
            // Create tasks for each project
            $this->createProjectTasks($project, $users);
        }

        // Create additional random tasks
        Task::factory()->count(20)->create();
    }

    private function createProjectTasks(Project $project, $users): void
    {
        $developerSenior = User::where('email', 'senior@project-reminder.com')->first();
        $developerJunior = User::where('email', 'junior@project-reminder.com')->first();
        $designer = User::where('email', 'designer@project-reminder.com')->first();
        $qa = User::where('email', 'qa@project-reminder.com')->first();
        $devops = User::where('email', 'devops@project-reminder.com')->first();

        // Create specific tasks based on project type
        if (str_contains(strtolower($project->name), 'e-commerce')) {
            $this->createEcommerceTasks($project, $developerSenior, $designer, $qa);
        } elseif (str_contains(strtolower($project->name), 'mobile')) {
            $this->createMobileAppTasks($project, $developerSenior, $developerJunior, $qa);
        } elseif (str_contains(strtolower($project->name), 'website')) {
            $this->createWebsiteTasks($project, $developerJunior, $designer, $qa);
        } else {
            $this->createGenericTasks($project, $users);
        }
    }

    private function createEcommerceTasks(Project $project, $senior, $designer, $qa): void
    {
        Task::factory()->create([
            'project_id' => $project->id,
            'assigned_to' => $designer->id,
            'title' => 'Design UI/UX untuk Halaman Produk',
            'description' => 'Membuat design yang menarik dan user-friendly untuk halaman produk dengan focus pada conversion rate.',
            'status' => 'completed',
            'priority' => 'high',
            'due_date' => now()->subDays(5),
        ]);

        Task::factory()->create([
            'project_id' => $project->id,
            'assigned_to' => $senior->id,
            'title' => 'Implementasi Payment Gateway',
            'description' => 'Mengintegrasikan payment gateway (Midtrans/OVO) dengan sistem e-commerce.',
            'status' => 'in_progress',
            'priority' => 'high',
            'due_date' => now()->addDays(7),
        ]);

        Task::factory()->create([
            'project_id' => $project->id,
            'assigned_to' => $senior->id,
            'title' => 'Setup Database untuk Inventori',
            'description' => 'Membuat struktur database yang optimal untuk manajemen inventori dan stok.',
            'status' => 'completed',
            'priority' => 'medium',
            'due_date' => now()->subDays(10),
        ]);

        Task::factory()->create([
            'project_id' => $project->id,
            'assigned_to' => $qa->id,
            'title' => 'Testing Payment Flow',
            'description' => 'Melakukan testing menyeluruh untuk flow pembayaran dan integrasi payment gateway.',
            'status' => 'not_started',
            'priority' => 'high',
            'due_date' => now()->addDays(3),
        ]);
    }

    private function createMobileAppTasks(Project $project, $senior, $junior, $qa): void
    {
        Task::factory()->create([
            'project_id' => $project->id,
            'assigned_to' => $senior->id,
            'title' => 'Setup React Native Project',
            'description' => 'Menginisialisasi project React Native dengan konfigurasi yang optimal.',
            'status' => 'completed',
            'priority' => 'medium',
            'due_date' => now()->subDays(15),
        ]);

        Task::factory()->create([
            'project_id' => $project->id,
            'assigned_to' => $junior->id,
            'title' => 'Implementasi Authentication',
            'description' => 'Membuat sistem login dan register dengan JWT token dan biometric authentication.',
            'status' => 'in_progress',
            'priority' => 'high',
            'due_date' => now()->addDays(5),
        ]);

        Task::factory()->create([
            'project_id' => $project->id,
            'assigned_to' => $senior->id,
            'title' => 'Integrasi API Backend',
            'description' => 'Mengintegrasikan aplikasi mobile dengan REST API backend.',
            'status' => 'not_started',
            'priority' => 'high',
            'due_date' => now()->addDays(10),
        ]);

        Task::factory()->create([
            'project_id' => $project->id,
            'assigned_to' => $qa->id,
            'title' => 'Testing di Multiple Devices',
            'description' => 'Melakukan testing di berbagai device dan OS untuk memastikan kompatibilitas.',
            'status' => 'not_started',
            'priority' => 'medium',
            'due_date' => now()->addDays(15),
        ]);
    }

    private function createWebsiteTasks(Project $project, $junior, $designer, $qa): void
    {
        Task::factory()->create([
            'project_id' => $project->id,
            'assigned_to' => $designer->id,
            'title' => 'Design Responsive Layout',
            'description' => 'Membuat design yang responsif untuk desktop, tablet, dan mobile.',
            'status' => 'completed',
            'priority' => 'medium',
            'due_date' => now()->subDays(8),
        ]);

        Task::factory()->create([
            'project_id' => $project->id,
            'assigned_to' => $junior->id,
            'title' => 'Implementasi Frontend dengan Tailwind',
            'description' => 'Mengembangkan frontend menggunakan Tailwind CSS dengan komponen yang reusable.',
            'status' => 'in_progress',
            'priority' => 'medium',
            'due_date' => now()->addDays(5),
        ]);

        Task::factory()->create([
            'project_id' => $project->id,
            'assigned_to' => $junior->id,
            'title' => 'Optimasi SEO',
            'description' => 'Mengoptimalkan website untuk search engine dengan meta tags dan structured data.',
            'status' => 'not_started',
            'priority' => 'low',
            'due_date' => now()->addDays(12),
        ]);

        Task::factory()->create([
            'project_id' => $project->id,
            'assigned_to' => $qa->id,
            'title' => 'Cross-browser Testing',
            'description' => 'Melakukan testing di berbagai browser untuk memastikan konsistensi tampilan.',
            'status' => 'not_started',
            'priority' => 'medium',
            'due_date' => now()->addDays(8),
        ]);
    }

    private function createGenericTasks(Project $project, $users): void
    {
        // Create a mix of tasks for generic projects
        Task::factory()->count(rand(3, 6))->create([
            'project_id' => $project->id,
            'assigned_to' => $users->random()->id,
        ]);
    }
} 