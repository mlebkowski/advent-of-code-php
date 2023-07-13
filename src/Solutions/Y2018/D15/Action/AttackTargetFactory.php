<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D15\Action;

use App\Solutions\Y2018\D15\Battleground;
use App\Solutions\Y2018\D15\DistanceOrder;
use App\Solutions\Y2018\D15\Unit;
use loophp\collection\Collection;

final readonly class AttackTargetFactory
{
    public static function make(Unit $unit, Battleground $battleground): ?Unit
    {
        $distanceSorter = DistanceOrder::fromUnit($unit);
        return Collection::fromIterable($battleground->enemies($unit))
            ->filter(static fn (Unit $enemy) => $enemy->inRange($unit))
            ->sort(
                callback: static fn (Unit $alpha, Unit $bravo) => $alpha->hp() <=> $bravo->hp()
                    ?: $distanceSorter->sort($alpha, $bravo),
            )
            ->first();
    }
}
