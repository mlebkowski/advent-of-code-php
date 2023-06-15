<?php

declare(strict_types=1);

namespace App\Aoc\Runner;

use App\Aoc\Challenge;
use App\Aoc\Solution;

/** @implements Solution<SampleInput> */
final class SampleSolution implements Solution
{
    public function challenges(): iterable
    {
        return [];
    }

    public function solve(Challenge $challenge, mixed $input): mixed
    {
        return null;
    }
}
