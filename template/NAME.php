<?php

declare(strict_types=1);

namespace App\Solutions\Y0000\D00;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/** @implements Solution<NAMEInput> */
final class NAME implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(0000, 00);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        return null;
    }
}
