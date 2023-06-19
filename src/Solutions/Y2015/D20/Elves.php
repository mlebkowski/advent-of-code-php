<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D20;

use Generator;

final class Elves
{
    public static function upTo(int $max): Generator
    {
        $number = 1;
        while ($number < $max) {
            yield $number++;
        }
    }
}
