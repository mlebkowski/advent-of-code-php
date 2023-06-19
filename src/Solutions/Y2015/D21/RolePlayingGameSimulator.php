<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/** @implements Solution<RolePlayingGameSimulatorInput> */
final class RolePlayingGameSimulator implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2015, 21);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        var_dump($input);
        return null;
    }
}
