<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D06;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;
use loophp\collection\Contract\Operation\Sortable;

/** @implements Solution<SignalsAndNoiseInput> */
final class SignalsAndNoise implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 06);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        return Collection::fromIterable($input->messages)
            ->map(static fn (string $message) => Collection::fromString($message)->all())
            ->transpose()
            ->flatMap(
                static fn (array $letters) => Collection::fromIterable($letters)
                    ->frequency()
                    ->sort(Sortable::BY_KEYS)
                    ->last(),
            )
            ->implode();
    }
}
