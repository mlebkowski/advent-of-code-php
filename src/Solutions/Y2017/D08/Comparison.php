<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D08;

enum Comparison: string
{
    case GreaterThan = '>';
    case GreaterThanOrEqual = '>=';
    case LessThan = '<';
    case LessThanOrEqual = '<=';
    case Equal = '==';
    case NotEqual = '!=';

    public function evaluate(int $alpha, int $bravo): bool
    {
        return match ($this) {
            self::GreaterThan => $alpha > $bravo,
            self::GreaterThanOrEqual => $alpha >= $bravo,
            self::LessThan => $alpha < $bravo,
            self::LessThanOrEqual => $alpha <= $bravo,
            self::Equal => $alpha === $bravo,
            self::NotEqual => $alpha !== $bravo,
        };
    }
}
