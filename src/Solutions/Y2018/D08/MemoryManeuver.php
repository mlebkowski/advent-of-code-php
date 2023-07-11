<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D08;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<MemoryManeuverInput>
 * @see file://var/2018-8.txt
 * @see file://var/2018-8-1-sample.txt
 * @see file://var/2018-8-1-expected.txt
 * @see file://var/2018-8-2-sample.txt
 * @see file://var/2018-8-2-expected.txt
 */
final class MemoryManeuver implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 8);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $stream = InputStream::of($input->numbers);
        $node = NodeBuilder::fromStream($stream);
        return $challenge->isPartOne() ? $node->sumMetadata() : $node->value();
    }
}
