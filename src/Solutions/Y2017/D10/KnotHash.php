<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D10;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<KnotHashInput>
 * @see file://var/2017-10.txt
 * @see file://var/2017-10-1-sample.txt
 * @see file://var/2017-10-1-expected.txt
 * @see file://var/2017-10-2-sample.txt
 * @see file://var/2017-10-2-expected.txt
 */
final class KnotHash implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 10);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $list = $runMode->isSample() ? range(0, 4) : range(0, 255);
        $i = 0;
        foreach ($input->asIntegers as $skipSize => $length) {
            $selection = array_slice($list, 0, $length);

            $list = array_merge(
                array_slice($list, $length),
                array_reverse($selection),
            );
            $list = array_merge(
                array_slice($list, $skipSize),
                array_slice($list, 0, $skipSize),
            );
            $i += $length + $skipSize;
        }
        $i %= count($list);

        $list = array_merge(
            array_slice($list, -$i),
            array_slice($list, 0, -$i),
        );

        return $list[0] * $list[1];
    }
}
