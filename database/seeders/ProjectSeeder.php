<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

final class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@project-reminder.com')->first();
        $manager = User::where('email', 'manager@project-reminder.com')->first();

        // Create specific projects
        Project::factory()->create([
            'name' => 'Pengembangan Website E-Commerce',
            'description' => 'Mengembangkan platform e-commerce yang modern dengan fitur payment gateway, manajemen inventori, dan dashboard admin yang komprehensif. Project ini bertujuan untuk meningkatkan penjualan online dan memberikan pengalaman belanja yang optimal bagi pelanggan.',
            'start_date' => now()->subMonths(2),
            'end_date' => now()->addMonths(1),
            'created_by' => $admin->id,
        ]);

        Project::factory()->create([
            'name' => 'Sistem Manajemen Inventori',
            'description' => 'Membuat sistem manajemen inventori yang terintegrasi dengan barcode scanner, laporan real-time, dan notifikasi stok menipis. Sistem ini akan membantu perusahaan mengoptimalkan pengelolaan stok dan mengurangi kerugian.',
            'start_date' => now()->subMonth(),
            'end_date' => now()->addMonths(2),
            'created_by' => $manager->id,
        ]);

        Project::factory()->create([
            'name' => 'Aplikasi Mobile Banking',
            'description' => 'Mengembangkan aplikasi mobile banking dengan fitur transfer, pembayaran, investasi, dan keamanan multi-layer. Aplikasi ini akan memberikan kemudahan akses layanan perbankan di mana saja dan kapan saja.',
            'start_date' => now()->subWeeks(2),
            'end_date' => now()->addMonths(3),
            'created_by' => $admin->id,
        ]);

        Project::factory()->create([
            'name' => 'Platform E-Learning',
            'description' => 'Membuat platform e-learning yang mendukung video conference, quiz interaktif, dan tracking progress siswa. Platform ini akan memudahkan proses pembelajaran jarak jauh dengan fitur yang komprehensif.',
            'start_date' => now()->addWeek(),
            'end_date' => now()->addMonths(4),
            'created_by' => $manager->id,
        ]);

        Project::factory()->create([
            'name' => 'Sistem CRM Perusahaan',
            'description' => 'Mengembangkan sistem CRM yang terintegrasi dengan sales pipeline, customer analytics, dan automation marketing. Sistem ini akan membantu tim sales mengelola leads dan meningkatkan conversion rate.',
            'start_date' => now()->subWeeks(3),
            'end_date' => now()->addMonths(2),
            'created_by' => $admin->id,
        ]);

        // Create completed projects
        Project::factory()->completed()->create([
            'name' => 'Website Portfolio',
            'description' => 'Membuat website portfolio yang responsif dan modern untuk showcase karya-karya terbaik. Website ini sudah selesai dan live.',
            'created_by' => $manager->id,
        ]);

        Project::factory()->completed()->create([
            'name' => 'Sistem Booking Online',
            'description' => 'Mengembangkan sistem booking online untuk layanan konsultasi dengan fitur calendar integration dan payment processing. Project ini sudah selesai dan beroperasi.',
            'created_by' => $admin->id,
        ]);

        // Create upcoming projects
        Project::factory()->upcoming()->create([
            'name' => 'Aplikasi Delivery Service',
            'description' => 'Mengembangkan aplikasi delivery service dengan real-time tracking, driver management, dan customer rating system.',
            'created_by' => $manager->id,
        ]);

        Project::factory()->upcoming()->create([
            'name' => 'Aplikasi Manajemen Keuangan',
            'description' => 'Membuat aplikasi manajemen keuangan pribadi dengan budgeting tools, expense tracking, dan financial reports.',
            'created_by' => $admin->id,
        ]);

        // Create additional random projects
        Project::factory()->active()->count(5)->create();
        Project::factory()->completed()->count(3)->create();
        Project::factory()->upcoming()->count(2)->create();
    }
} 