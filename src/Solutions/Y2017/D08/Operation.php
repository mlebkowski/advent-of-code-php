<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D08;

enum Operation: string
{
    case Inc = 'inc';
    case Dec = 'dec';

    public function multiplier(): int
    {
        return $this === self::Inc ? 1 : -1;
    }
}
