<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-6 months', '+1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, '+6 months');

        return [
            'name' => $this->faker->randomElement([
                'Pengembangan Website E-Commerce',
                'Sistem Manajemen Inventori',
                'Aplikasi Mobile Banking',
                'Platform E-Learning',
                'Sistem CRM Perusahaan',
                'Aplikasi Delivery Service',
                'Website Portfolio',
                'Sistem Booking Online',
                'Aplikasi Manajemen Keuangan',
                'Platform Social Media',
            ]),
            'description' => $this->faker->paragraphs(3, true),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'created_by' => User::factory(),
        ];
    }

    public function active(): static
    {
        return $this->state(function (array $attributes) {
            $startDate = now()->subDays(rand(1, 30));
            $endDate = now()->addDays(rand(30, 90));

            return [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ];
        });
    }

    public function completed(): static
    {
        return $this->state(function (array $attributes) {
            $startDate = now()->subDays(rand(60, 120));
            $endDate = now()->subDays(rand(1, 30));

            return [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ];
        });
    }

    public function upcoming(): static
    {
        return $this->state(function (array $attributes) {
            $startDate = now()->addDays(rand(7, 30));
            $endDate = now()->addDays(rand(60, 120));

            return [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ];
        });
    }
} 