<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D23;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

/**
 * @implements Solution<SafeCrackingInput>
 * @see file://var/2016-23.txt
 * @see file://var/2016-23-1-sample.txt
 * @see file://var/2016-23-1-expected.txt
 * @see file://var/2016-23-2-sample.txt
 * @see file://var/2016-23-2-expected.txt
 */
final class SafeCracking implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 23);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $progress = Progress::ofExpectedIterations(count($input->instructions));
        $processor = Processor::of($progress, ...$input->instructions);
        $processor->setRegister(Register::A, 7);
        $processor->run();
        return $processor->readRegister(Register::A);
    }
}
