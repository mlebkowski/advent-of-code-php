<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D04;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/**
 * @implements Solution<HighEntropyPassphrasesInput>
 * @see file://var/2017-4.txt
 * @see file://var/2017-4-1-sample.txt
 * @see file://var/2017-4-1-expected.txt
 * @see file://var/2017-4-2-sample.txt
 * @see file://var/2017-4-2-expected.txt
 */
final class HighEntropyPassphrases implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 4);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $additionalSecurity = strval(...);
        if ($challenge->isPartTwo()) {
            $additionalSecurity = static fn (string $word) => Collection::fromString($word)->sort()->implode();
        }

        return Collection::fromIterable($input->passphrases)
            ->map(static fn (string $passphrase) => explode(' ', $passphrase))
            ->map(static fn (array $words) => array_map($additionalSecurity, $words))
            ->filter(static fn (array $words) => array_unique($words) === $words)
            ->count();
    }
}
