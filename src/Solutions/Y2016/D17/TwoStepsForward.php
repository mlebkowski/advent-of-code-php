<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D17;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<TwoStepsForwardInput>
 * @see file://var/2016-17.txt
 * @see file://var/2016-17-1-sample.txt
 * @see file://var/2016-17-1-expected.txt
 * @see file://var/2016-17-2-sample.txt
 * @see file://var/2016-17-2-expected.txt
 */
final class TwoStepsForward implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 17);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $environment = Environment::of(width: 4, height: 4, passcode: $input->passcode);
        if ($challenge->isPartOne()) {
            return Journey::shortestPathToVault($environment);
        }

        return Journey::longestPathToVaultLength($environment);
    }
}
