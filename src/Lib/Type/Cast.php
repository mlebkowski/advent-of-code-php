<?php
declare(strict_types=1);

namespace App\Lib\Type;

use RuntimeException;

final readonly class Cast
{
    public static function toInt(mixed $value): int
    {
        if (false === is_numeric($value)) {
            throw new RuntimeException("Error casting non-numeric value to integer: $value");
        }
        
        return (int)$value;
    }
}
