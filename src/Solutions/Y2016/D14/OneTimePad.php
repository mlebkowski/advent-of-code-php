<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D14;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Passwords\HashGenerator;
use loophp\collection\Collection;

/** @implements Solution<OneTimePadInput> */
final class OneTimePad implements Solution
{
    private const CandidateRe = '/(.)\1\1/';

    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 14);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $progress = Progress::unknown()->reportInSteps(100);
        $rehashCount = $challenge->isPartOne() ? 0 : 2016;

        $state = Arbiter::of(
            HashGenerator::of($input->salt, rehashCount: $rehashCount),
            lookaheadWindow: 1000,
        );

        return Collection::fromGenerator(HashGenerator::of($input->salt, rehashCount: $rehashCount))
            ->apply($progress->step(...))
            ->filter(static fn (string $hash) => 1 === preg_match(self::CandidateRe, $hash))
            ->apply($progress->report(...))
            ->filter($state->hasCounterpart(...))
            ->slice(0, 64)
            ->keys()
            ->last();
    }
}
