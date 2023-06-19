<?php

declare(strict_types=1);

namespace App\Aoc\Progress;

use Stringable;

final class MemoryUsage implements Stringable
{
    public function __toString(): string
    {
        $suffixes = ['', 'k', 'M', 'G'];
        $usage = memory_get_usage();
        while ($usage > 1_000) {
            $usage /= 1000;
            array_shift($suffixes);
        }
        return sprintf('%.2f%s', $usage, reset($suffixes));
    }
}
