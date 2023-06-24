<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D05;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/** @implements Solution<HowAboutANiceGameOfChessInput> */
final class HowAboutANiceGameOfChess implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 05);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $expectedIterations = $challenge->isPartOne() ? 13_000_000 : 28_000_000;
        $progress = Progress::ofExpectedIterations($expectedIterations)
            ->reportInSteps(100_000);

        $password = $challenge->isPartOne()
            ? Password::ofSimpleStrategy()
            : Password::ofSlightlyMoreInspiredSecurityMechanism();

        return PasswordCracking::of($input->doorId, $progress, $password);
    }
}
