<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D23;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Computing\Optimizer\OptimizerFactory;
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
        $progress = Progress::ofExpectedIterations(1_380_000_000)->reportInSteps(1_000_000);
        $optimizer = OptimizerFactory::make();
        $instructions = $optimizer->optimize(...$input->instructions);
        $processor = Processor::of($progress, ...$instructions);
        $value = $challenge->isPartOne() ? 7 : 12;
        $processor->setRegister(Register::A, $value);
        $processor->run();
        return $processor->readRegister(Register::A);
    }
}
