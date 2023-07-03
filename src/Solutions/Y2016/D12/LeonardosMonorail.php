<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D12;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

/** @implements Solution<LeonardosMonorailInput> */
final class LeonardosMonorail implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 12);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $progress = Progress::unknown()->reportInSteps(100_000);
        $processor = Processor::of($progress, ...$input->instructions);

        if ($challenge->isPartTwo()) {
            $processor->setRegister(Register::C, 1);
        }

        $processor->run();
        return $processor->readRegister(Register::A);
    }
}
