<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D13;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
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
        $firewall = Firewall::of(...$input->specs);
        $visualizer = Visualizer::ofSpecs($firewall);
        $progress = Progress::unknown()->reportInSteps(10_000);

        $delay = 0;
        if ($challenge->isPartTwo()) {
            $delay = (int)Collection::range()
                ->apply($progress->iterate(...))
                ->find(
                    PHP_INT_MAX,
                    static fn (float $delay) => $firewall->avoidsDetection((int)$delay),
                );
        }

        echo "\n";
        Collection::fromGenerator($visualizer->start($delay))
            ->apply(static fn (string $output) => print($output))
            ->squash();
        echo "\n";

        if ($challenge->isPartOne()) {
            return $firewall->tripSeverity();
        }

        return $delay;
    }
}
