<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D25;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<TheHaltingProblemInput>
 * @see file://var/2017-25.txt
 * @see file://var/2017-25-1-sample.txt
 * @see file://var/2017-25-1-expected.txt
 * @see file://var/2017-25-2-sample.txt
 * @see file://var/2017-25-2-expected.txt
 */
final class TheHaltingProblem implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 25);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $iterations = $input->blueprint->checksumAfter;
        $progress = Progress::ofExpectedIterations($iterations)->reportInSteps(100_000);
        $machine = TuringMachine::some($input->blueprint);
        while ($iterations-- > 0) {
            $machine->step();
            $progress->iterate($iterations);
        }

        return $machine->diagnosticChecksum();
    }
}
