<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D07;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<RecursiveCircusInput>
 * @see file://var/2017-7.txt
 * @see file://var/2017-7-1-sample.txt
 * @see file://var/2017-7-1-expected.txt
 * @see file://var/2017-7-2-sample.txt
 * @see file://var/2017-7-2-expected.txt
 */
final class RecursiveCircus implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 7);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        return TowerBuilder::buildFromShouts(...$input->shouts)->root->name;
    }
}
