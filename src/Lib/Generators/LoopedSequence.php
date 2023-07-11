<?php
declare(strict_types=1);

namespace App\Lib\Generators;

use Generator;

final readonly class LoopedSequence
{
    public static function of(array $sequence): Generator
    {
        while (true) {
            yield from $sequence;
        }
    }
}
