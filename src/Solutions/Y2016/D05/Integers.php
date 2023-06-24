<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D05;

use Generator;

final class Integers
{
    public static function all(): Generator
    {
        $i = 0;
        while (true) {
            yield $i++;
        }
    }
}
