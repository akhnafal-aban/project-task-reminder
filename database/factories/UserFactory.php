<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Ahmad Rizki',
                'Siti Nurhaliza',
                'Budi Santoso',
                'Dewi Sartika',
                'Eko Prasetyo',
                'Fatimah Azzahra',
                'Gunawan Setiawan',
                'Hesti Wulandari',
                'Indra Kusuma',
                'Joko Widodo',
                'Kartika Sari',
                'Lukman Hakim',
                'Maya Indah',
                'Nugroho Pratama',
                'Oktavia Putri',
                'Prabowo Subianto',
                'Rina Marlina',
                'Sugeng Riyadi',
                'Tika Permata',
                'Umar Said',
            ]),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => $this->faker->randomElement(['admin', 'member']),
            'remember_token' => Str::random(10),
        ];
    }

    public function admin(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'admin',
            ];
        });
    }

    public function member(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'member',
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
