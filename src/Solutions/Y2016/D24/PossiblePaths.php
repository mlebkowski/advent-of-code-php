<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D24;

use Generator;

final class PossiblePaths
{
    public static function ofPoints(array $points): Generator
    {
        if (count($points) <= 1) {
            yield $points;
            return;
        }

        foreach ($points as $idx => $first) {
            $rest = array_diff_key($points, [$idx => true]);
            foreach (self::ofPoints($rest) as $others) {
                yield [$first, ...$others];
            }
        }
    }
}
