<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D15;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<BeverageBanditsInput>
 * @see file://var/2018-15.txt
 * @see file://var/2018-15-1-sample.txt
 * @see file://var/2018-15-1-expected.txt
 * @see file://var/2018-15-2-sample.txt
 * @see file://var/2018-15-2-expected.txt
 */
final class BeverageBandits implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 15);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $battleground = BattlegroundFactory::create($input->map);

        Combat::animate($battleground);
        $rounds = $battleground->countRounds() - 1;
        $hp = array_sum(array_map(static fn (Unit $unit) => $unit->hp(), $battleground->units()));
        return $rounds * $hp;
    }
}
