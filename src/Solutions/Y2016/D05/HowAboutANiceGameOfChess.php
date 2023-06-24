<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D05;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/** @implements Solution<HowAboutANiceGameOfChessInput> */
final class HowAboutANiceGameOfChess implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 05);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $magicValue = '0';
        $length = 5;
        $passwordLength = 8;
        $doorId = $input->doorId;

        $prefix = str_repeat($magicValue, $length);

        $progress = Progress::ofExpectedIterations(13_000_000)
            ->reportInSteps(100_000);

        return Collection::fromGenerator(Integers::all())
            ->apply($progress->step(...))
            ->map(static fn (int $k) => md5($doorId . $k))
            ->apply($progress->report(...))
            ->filter(static fn (string $hash) => str_starts_with($hash, $prefix))
            ->slice(0, $passwordLength)
            ->map(static fn (string $hash) => $hash[$length])
            ->implode();
    }
}
