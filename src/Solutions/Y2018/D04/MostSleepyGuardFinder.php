<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D04;

use loophp\collection\Collection;

final class MostSleepyGuardFinder
{
    public static function of(Year $year): GuardHistory
    {
        return Collection::fromIterable($year->guardHistory())
            ->sort(callback: GuardHistory::sortMostMinutesAsleep(...))
            ->first();
    }
}
