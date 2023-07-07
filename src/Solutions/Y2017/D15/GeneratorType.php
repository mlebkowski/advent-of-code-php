<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D15;

enum GeneratorType: string
{
    case A = 'A';
    case B = 'B';

    public function factor(): int
    {
        return match ($this) {
            self::A => 16807,
            self::B => 48271,
        };
    }

    public function multiples(): int
    {
        return match ($this) {
            self::A => 4,
            self::B => 8,
        };
    }
}
