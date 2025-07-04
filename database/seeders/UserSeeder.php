<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    const ADMIN_EMAIL = '22523179@students.uii.ac.id';
    const AKHNAFAL_EMAIL = 'akhnafal03@gmail.com';
    public function run(): void
    {
        // Create admin users
        User::factory()->admin()->create([
            'name' => 'admin',
            'email' => self::ADMIN_EMAIL,
            'password' => bcrypt('password'),
        ]);

        User::factory()->admin()->create([
            'name' => 'Manager Proyek',
            'email' => 'manager@project-reminder.com',
            'password' => bcrypt('password'),
        ]);

        // Create member users
        User::factory()->member()->create([
            'name' => 'akhnafal',
            'email' => self::AKHNAFAL_EMAIL,
            'password' => bcrypt('password'),
        ]);

        User::factory()->member()->create([
            'name' => 'Developer Senior',
            'email' => 'senior@project-reminder.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->member()->create([
            'name' => 'Developer Junior',
            'email' => 'junior@project-reminder.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->member()->create([
            'name' => 'UI/UX Designer',
            'email' => 'designer@project-reminder.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->member()->create([
            'name' => 'QA Tester',
            'email' => 'qa@project-reminder.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->member()->create([
            'name' => 'DevOps Engineer',
            'email' => 'devops@project-reminder.com',
            'password' => bcrypt('password'),
        ]);

        // Create additional random users
        User::factory()->admin()->count(2)->create();
        User::factory()->member()->count(8)->create();
    }
} 