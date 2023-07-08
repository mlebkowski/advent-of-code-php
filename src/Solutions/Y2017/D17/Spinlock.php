<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D17;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/**
 * @implements Solution<SpinlockInput>
 * @see file://var/2017-17.txt
 * @see file://var/2017-17-1-sample.txt
 * @see file://var/2017-17-1-expected.txt
 * @see file://var/2017-17-2-sample.txt
 * @see file://var/2017-17-2-expected.txt
 */
final class Spinlock implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 17);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $buffer = Collection::range(0, 2018)
            ->reduce(
                static fn (CircularBuffer $buffer) => $buffer->iterate(),
                CircularBuffer::of($input->step),
            );

        if ($challenge->isPartOne()) {
            return $buffer->after(2017);
        }

        $iterations = 50_000_000;
        $buffer = CircularBuffer::simulate($input->step);
        while ($buffer->count() < $iterations) {
            $buffer->iterate();
        }
        return $buffer->secondValue();
    }
}
