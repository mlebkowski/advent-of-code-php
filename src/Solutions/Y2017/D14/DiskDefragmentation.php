<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D14;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<DiskDefragmentationInput>
 * @see file://var/2017-14.txt
 * @see file://var/2017-14-1-sample.txt
 * @see file://var/2017-14-1-expected.txt
 * @see file://var/2017-14-2-sample.txt
 * @see file://var/2017-14-2-expected.txt
 */
final class DiskDefragmentation implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 14);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $disk = DiskBuilder::fromKeyString($input->keyString);
        return substr_count((string)$disk, '#');
    }
}
