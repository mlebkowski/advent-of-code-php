<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D01;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/**
 * @implements Solution<InverseCaptchaInput>
 * @see file://var/2017-1.txt
 * @see file://var/2017-1-1-sample.txt
 * @see file://var/2017-1-1-expected.txt
 * @see file://var/2017-1-2-sample.txt
 * @see file://var/2017-1-2-expected.txt
 */
final class InverseCaptcha implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 1);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $offset = $challenge->isPartOne() ? 1 : strlen($input->digits) / 2;

        $zip = substr($input->digits, $offset) . substr($input->digits, 0, $offset);

        return Collection::fromString($input->digits)
            ->zip(Collection::fromString($zip))
            ->filter(static fn (array $pair) => reset($pair) === end($pair))
            ->map(static fn (array $pair) => (int)reset($pair))
            ->reduce(static fn (int $sum, int $digit) => $sum + $digit, 0);

    }
}
