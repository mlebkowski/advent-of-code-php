<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D25;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/** @implements Solution<LetItSnowInput> */
final class LetItSnow implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2015, 25);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        return CodeGenerator::at($input->row, $input->column);
    }
}
