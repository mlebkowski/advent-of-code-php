<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D07;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<TheSumOfItsPartsInput>
 * @see file://var/2018-7.txt
 * @see file://var/2018-7-1-sample.txt
 * @see file://var/2018-7-1-expected.txt
 * @see file://var/2018-7-2-sample.txt
 * @see file://var/2018-7-2-expected.txt
 */
final class TheSumOfItsParts implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 7);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): string|int
    {
        $steps = AssemblyProcess::ofRules(...$input->rules);
        $workers = $runMode->isSample() ? 2 : 5;
        $stepDuration = $runMode->isSample() ? 0 : 60;
        $factory = Factory::of($stepDuration, $workers);
        $process = $factory->assemble($steps);

        echo "\n\n";
        self::printLine([
            'Second',
            ...
            array_map(
                static fn (int $n) => "Worker $n",
                range(1, $workers),
            ),
            'Done',
        ]);
        foreach ($process as $status) {
            self::printLine($status);
        }
        echo "\n";
        $report = $process->getReturn();

        return $challenge->isPartOne() ? $report->assemblyOrder : $report->time;
    }

    private static function printLine(array $items): void
    {
        $width = 10;
        $last = str_pad((string)array_pop($items), $width);
        $items = array_map(
            static fn (mixed $item) => str_pad((string)$item, $width, pad_type: STR_PAD_BOTH),
            $items,
        );
        echo implode(' ', [...$items, $last]), "\n";
    }
}
