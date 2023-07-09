<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D18;

use App\Aoc\Challenge;
use App\Aoc\Part;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Computing\IO\EnterpriseMessageBus;
use App\Realms\Computing\IO\Stdout;
use App\Realms\Computing\IO\StreamCopy;
use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;
use loophp\collection\Collection;

/**
 * @implements Solution<DuetInput>
 * @see file://var/2017-18.txt
 * @see file://var/2017-18-1-sample.txt
 * @see file://var/2017-18-1-expected.txt
 * @see file://var/2017-18-2-sample.txt
 * @see file://var/2017-18-2-expected.txt
 */
final class Duet implements Solution
{
    public function challenges(): iterable
    {
        yield Challenge::of(2017, 18, Part::Two);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $progress = Progress::unknown()->reportInSteps(10);
        $ioDevice = StreamCopy::of(new Stdout());

        $alpha = Processor::of($progress, ...$input->instructions);
        $alpha->setRegister(Register::P, 0);
        $alpha->attachOutputDevice(new Stdout());

        $bravo = Processor::of($progress, ...$input->instructions);
        $bravo->setRegister(Register::P, 1);
        $bravo->attachOutputDevice($ioDevice);

        EnterpriseMessageBus::between($alpha, $bravo);

        $buffer = $ioDevice->other->consumeOutputBuffer();
        return Collection::fromIterable($buffer)->count();
    }
}
