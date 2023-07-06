<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D13;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Solutions\Y2017\D13\Visualizer\Visualizer;
use loophp\collection\Collection;

/**
 * @implements Solution<PacketScannersInput>
 * @see file://var/2017-13.txt
 * @see file://var/2017-13-1-sample.txt
 * @see file://var/2017-13-1-expected.txt
 * @see file://var/2017-13-2-sample.txt
 * @see file://var/2017-13-2-expected.txt
 */
final class PacketScanners implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 13);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $visualizer = Visualizer::ofSpecs(...$input->specs);
        echo "\n";
        Collection::fromGenerator($visualizer->start())
            ->apply(static fn (string $output) => print($output))
            ->squash();
        echo "\n";
        return Collection::fromIterable($input->specs)
            ->filter(static fn (Spec $spec) => $spec->catchesPacket())
            ->reduce(static fn (int $sum, Spec $spec) => $sum + $spec->severity(), 0);
    }
}
