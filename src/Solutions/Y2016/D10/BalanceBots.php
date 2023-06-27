<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D10;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/** @implements Solution<BalanceBotsInput> */
final class BalanceBots implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 10);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        var_dump($input);
        return null;
    }
}
