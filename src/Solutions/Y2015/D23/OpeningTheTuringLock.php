<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D23;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Solutions\Y2015\D23\Instruction\Register;

/** @implements Solution<Input\OpeningTheTuringLockInput> */
final class OpeningTheTuringLock implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2015, 23);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $processor = new Processor(Progress::unknown());
        $processor->run(...$input->instructions);

        return $processor->readRegister(Register::B);
    }
}
