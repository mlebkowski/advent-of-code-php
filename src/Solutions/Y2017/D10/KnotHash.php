<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D10;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

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
    private const FixedLengthsToAdd = [17, 31, 73, 47, 23];
    private const IterationsCount = 64;

    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 10);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $list = $runMode->isSample() ? range(0, 4) : range(0, 255);

        $asCharCodes = Collection::range(0, self::IterationsCount)
            ->flatMap(static fn () => [...$input->asCharCodes, ...self::FixedLengthsToAdd])
            ->all();

        $lengths = $challenge->isPartOne() ? $input->asIntegers : $asCharCodes;

        $i = 0;
        foreach ($lengths as $skipSize => $length) {
            $selection = array_slice($list, 0, $length);
            $skipSize %= count($list);

            $list = array_merge(
                array_slice($list, $length),
                array_reverse($selection),
            );
            $list = array_merge(
                array_slice($list, $skipSize),
                array_slice($list, 0, $skipSize),
            );
            $i = ($i + $length + $skipSize) % count($list);
        }

        $sparseHash = array_merge(
            array_slice($list, -$i),
            array_slice($list, 0, -$i),
        );

        if ($challenge->isPartOne()) {
            return $list[0] * $list[1];
        }

        $xor = static fn (array $elements) => array_reduce(
            $elements,
            static fn (int $alpha, int $bravo) => $alpha ^ $bravo,
            0,
        );
        $toHex = static fn (int $number) => str_pad(dechex($number), 2, '0', STR_PAD_LEFT);

        return Collection::fromIterable($sparseHash)
            ->chunk(16)
            ->mapN($xor, $toHex)
            ->implode();
    }
}
