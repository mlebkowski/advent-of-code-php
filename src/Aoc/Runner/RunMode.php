<?php

declare(strict_types=1);

namespace App\Aoc\Runner;

enum RunMode
{
    case Sample;
    case Actual;

    public function isSample(): bool
    {
        return $this === self::Sample;
    }
}
