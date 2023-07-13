<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D13;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Solutions\Y2018\D13\Input\CartFinder;
use App\Solutions\Y2018\D13\Input\PathConverter;

/**
 * @implements Solution<MineCartMadnessInput>
 * @see file://var/2018-13.txt
 * @see file://var/2018-13-1-sample.txt
 * @see file://var/2018-13-1-expected.txt
 * @see file://var/2018-13-2-sample.txt
 * @see file://var/2018-13-2-expected.txt
 */
final class MineCartMadness implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 13);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $carts = CartFinder::fromDrawing($input->map);
        $map = PathConverter::convert($input->map);
        echo "\n\n";
        CartAnimator::animate($map, Fleet::of(...$carts));
        return null;
    }
}
