<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D23;

use App\Aoc\Challenge;
use App\Aoc\Part;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Computing\Optimizer\OptimizerFactory;
use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

/**
 * @implements Solution<CoprocessorConflagrationInput>
 * @see file://var/2017-23.txt
 * @see file://var/2017-23-1-sample.txt
 * @see file://var/2017-23-1-expected.txt
 * @see file://var/2017-23-2-sample.txt
 * @see file://var/2017-23-2-expected.txt
 */
final class CoprocessorConflagrationPartTwo implements Solution
{
    public function challenges(): iterable
    {
        yield Challenge::of(2017, 23, Part::Two);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $instructions = OptimizerFactory::make()->optimize(...$input->instructions);

        $processor = Processor::ofInstructions(...$instructions);

        $processor->setRegister(Register::A, 1);
        $processor->run();
        return $processor->readRegister(Register::H);
    }
}
