<?php

declare(strict_types=1);

namespace App\Enums;

enum TaskPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Rendah',
            self::MEDIUM => 'Sedang',
            self::HIGH => 'Tinggi',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::LOW => 'green',
            self::MEDIUM => 'yellow',
            self::HIGH => 'red',
        };
    }

    public function isHigh(): bool
    {
        return $this === self::HIGH;
    }

    public function isMedium(): bool
    {
        return $this === self::MEDIUM;
    }

    public function isLow(): bool
    {
        return $this === self::LOW;
    }
}
