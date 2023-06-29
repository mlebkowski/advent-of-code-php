<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D16;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/**
 * @implements Solution<DragonChecksumInput>
 * @see file://var/2016-16.txt
 * @see file://var/2016-16-1-sample.txt
 * @see file://var/2016-16-1-expected.txt
 * @see file://var/2016-16-2-sample.txt
 * @see file://var/2016-16-2-expected.txt
 */
final class DragonChecksum implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 16);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): string
    {
        $size = $runMode->isSample() ? 20 : 272;
        $data = Collection::fromGenerator(DragonCurveGenerator::ofInitialState($input->initialState))
            ->find('!', static fn (string $data) => strlen($data) > $size);

        return DragonCurveGenerator::reduce(substr($data, 0, $size));
    }
}
