<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D05;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Computing\Processor\Processor;
use loophp\collection\Collection;

/**
 * @implements Solution<AMazeOfTwistyTrampolinesAllAlikeInput>
 * @see file://var/2017-5.txt
 * @see file://var/2017-5-1-sample.txt
 * @see file://var/2017-5-1-expected.txt
 * @see file://var/2017-5-2-sample.txt
 * @see file://var/2017-5-2-expected.txt
 */
final class AMazeOfTwistyTrampolinesAllAlike implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 5);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $instructions = Collection::fromIterable($input->jumps)
            ->map(LittleStrangeJump::of(...))
            ->all();
        $processor = Processor::ofInstructions(...$instructions);
        $processor->run();
        return $processor->steps();
    }
}
