<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D23;

use App\Aoc\Challenge;
use App\Aoc\Part;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Computing\IO\Stdout;
use App\Realms\Computing\Processor\Processor;
use loophp\collection\Collection;

/**
 * @implements Solution<CoprocessorConflagrationInput>
 * @see file://var/2017-23.txt
 * @see file://var/2017-23-1-sample.txt
 * @see file://var/2017-23-1-expected.txt
 * @see file://var/2017-23-2-sample.txt
 * @see file://var/2017-23-2-expected.txt
 */
final class CoprocessorConflagrationPartOne implements Solution
{
    public function challenges(): iterable
    {
        yield Challenge::of(2017, 23, Part::One);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $instructions = array_map(Strace::of(...), $input->instructions);

        $processor = Processor::ofInstructions(...$instructions);
        $stdout = new Stdout();
        $processor->attachOutputDevice($stdout);

        $processor->run();
        return Collection::fromIterable($stdout->consumeOutputBuffer())
            ->filter(static fn (string $instruction) => str_starts_with($instruction, 'mul '))
            ->count();
    }
}
