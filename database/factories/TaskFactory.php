<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'assigned_to' => User::factory(),
            'title' => $this->faker->randomElement([
                'Membuat Wireframe UI/UX',
                'Setup Database Schema',
                'Implementasi Authentication',
                'Integrasi Payment Gateway',
                'Testing Unit dan Integration',
                'Deploy ke Production Server',
                'Optimasi Performa Website',
                'Setup CI/CD Pipeline',
                'Dokumentasi API',
                'Training Tim Development',
                'Review Code dan Refactoring',
                'Setup Monitoring dan Logging',
                'Implementasi Search Function',
                'Membuat Dashboard Admin',
                'Testing User Acceptance',
                'Setup Backup dan Recovery',
                'Implementasi Notifikasi',
                'Optimasi SEO',
                'Setup Security Headers',
                'Membuat User Manual',
            ]),
            'description' => $this->faker->paragraphs(2, true),
            'status' => $this->faker->randomElement(['not_started', 'in_progress', 'completed']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'due_date' => $this->faker->dateTimeBetween('now', '+2 months'),
            'reminder_sent' => $this->faker->boolean(20),
        ];
    }

    public function notStarted(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'not_started',
                'reminder_sent' => false,
            ];
        });
    }

    public function inProgress(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'in_progress',
                'reminder_sent' => false,
            ];
        });
    }

    public function completed(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'completed',
                'reminder_sent' => true,
            ];
        });
    }

    public function highPriority(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'priority' => 'high',
            ];
        });
    }

    public function mediumPriority(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'priority' => 'medium',
            ];
        });
    }

    public function lowPriority(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'priority' => 'low',
            ];
        });
    }

    public function overdue(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'due_date' => $this->faker->dateTimeBetween('-30 days', '-1 day'),
                'status' => $this->faker->randomElement(['not_started', 'in_progress']),
            ];
        });
    }

    public function dueSoon(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'due_date' => $this->faker->dateTimeBetween('now', '+3 days'),
                'status' => $this->faker->randomElement(['not_started', 'in_progress']),
            ];
        });
    }
} 