<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D18;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Computing\IO\InputOutputListener;
use App\Realms\Computing\IO\SoundDevice;
use App\Realms\Computing\IO\Stdout;
use App\Realms\Computing\Processor\Processor;
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
        return Challenge::bothParts(2017, 18);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $processor = Processor::of(Progress::unknown(), ...$input->instructions);
        $processor->attachIODevice(SoundDevice::muted());
        $io = InputOutputListener::of($processor, new Stdout());
        return Collection::fromGenerator($io)->first();
    }
}
