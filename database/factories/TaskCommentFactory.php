<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class TaskCommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'task_id' => Task::factory(),
            'user_id' => User::factory(),
            'comment' => $this->faker->randomElement([
                'Task ini sudah selesai dikerjakan, mohon review hasilnya.',
                'Ada beberapa kendala teknis yang perlu diselesaikan terlebih dahulu.',
                'Progress sudah mencapai 70%, diperkirakan selesai dalam 2 hari.',
                'Mohon feedback untuk implementasi yang sudah dibuat.',
                'Testing sudah dilakukan dan semua fitur berfungsi dengan baik.',
                'Perlu koordinasi dengan tim backend untuk integrasi API.',
                'Design sudah disetujui client, bisa lanjut ke tahap development.',
                'Ada bug minor yang ditemukan, sedang dalam proses perbaikan.',
                'Dokumentasi sudah diperbarui sesuai dengan perubahan terbaru.',
                'Deployment ke staging environment sudah berhasil.',
                'Perlu meeting untuk diskusi requirement yang baru.',
                'Optimasi performa sudah dilakukan, loading time berkurang 50%.',
                'Security audit sudah selesai, tidak ada vulnerability yang ditemukan.',
                'User acceptance testing sudah dilakukan, semua kriteria terpenuhi.',
                'Backup database sudah dibuat dan disimpan dengan aman.',
                'Monitoring system sudah aktif dan berjalan dengan baik.',
                'Code review sudah selesai, semua feedback sudah diimplementasi.',
                'Training untuk user sudah dijadwalkan untuk minggu depan.',
                'Maintenance schedule sudah diatur untuk setiap minggu.',
                'Performance testing menunjukkan hasil yang memuaskan.',
            ]),
        ];
    }

    public function positive(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'comment' => $this->faker->randomElement([
                    'Excellent! Task ini sudah selesai dengan sempurna.',
                    'Hasil kerja sangat memuaskan, semua requirement terpenuhi.',
                    'Progress sangat baik, bisa selesai lebih cepat dari estimasi.',
                    'Kualitas kode sangat bagus, mudah untuk maintenance.',
                    'Testing berhasil 100%, tidak ada bug yang ditemukan.',
                ]),
            ];
        });
    }

    public function issue(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'comment' => $this->faker->randomElement([
                    'Ada kendala teknis yang perlu diselesaikan segera.',
                    'Perlu bantuan untuk mengatasi bug yang ditemukan.',
                    'Ada konflik dengan dependency yang perlu diresolve.',
                    'Server mengalami downtime, perlu investigasi lebih lanjut.',
                    'Performance issue ditemukan, perlu optimasi.',
                ]),
            ];
        });
    }

    public function question(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'comment' => $this->faker->randomElement([
                    'Mohon klarifikasi untuk requirement yang kurang jelas.',
                    'Apakah ada guideline khusus untuk implementasi ini?',
                    'Bagaimana cara terbaik untuk handle edge case ini?',
                    'Perlu konfirmasi untuk timeline yang diusulkan.',
                    'Ada pertanyaan tentang integrasi dengan sistem lain.',
                ]),
            ];
        });
    }
} 