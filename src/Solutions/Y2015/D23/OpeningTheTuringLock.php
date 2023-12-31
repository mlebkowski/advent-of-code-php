<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D23;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

/** @implements Solution<OpeningTheTuringLockInput> */
final class OpeningTheTuringLock implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2015, 23);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $processor = Processor::of(Progress::unknown(), ...$input->instructions);
        if ($challenge->isPartTwo()) {
            $processor->setRegister(Register::A, 1);
        }
        $processor->run();

        return $processor->readRegister(Register::B);
    }
}
