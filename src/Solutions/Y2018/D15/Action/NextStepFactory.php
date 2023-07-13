<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D15\Action;

use App\Realms\Cartography\Path;
use App\Realms\Cartography\Point;
use App\Solutions\Y2018\D15\Battleground;
use App\Solutions\Y2018\D15\Unit;
use loophp\collection\Collection;

final readonly class NextStepFactory
{
    public static function create(Unit $unit, Battleground $battleground): Point
    {
        $enemies = Collection::fromIterable($battleground->enemies($unit));
        $inRange = $enemies->filter(static fn (Unit $enemy) => $enemy->inRange($unit));
        if ($inRange->isNotEmpty()) {
            return $unit->position;
        }

        $pathFinding = $battleground->pathFinding($unit);
        return $enemies
            ->flatMap(static fn (Unit $unit) => $unit->position->orthogonallyAdjacent())
            ->map(static fn (Point $target) => $pathFinding->tryGetPath($unit->position, $target))
            ->filter()
            ->sort(
                callback: static fn (Path $alpha, Path $bravo) => Path::shortest($alpha, $bravo)
                    ?: Point::sortForGrid($alpha->lastPosition, $bravo->lastPosition),
            )
            ->limit(1)
            ->map(static fn (Path $path) => $path->lastPosition)
            ->flatMap(
                static fn (Point $point) => Collection::fromIterable($unit->position->orthogonallyAdjacent())
                    ->map(static fn (Point $target) => $pathFinding->tryGetPath($unit->position, $target))
                    ->filter()
                    ->map(
                        static fn (Path $path) => $pathFinding->tryGetPath($path->lastPosition, $point),
                    ),
            )
            ->filter()
            ->sort(
                callback: static fn (Path $alpha, Path $bravo) => Path::shortest($alpha, $bravo)
                    ?: Point::sortForGrid($alpha->firstPosition, $bravo->firstPosition),
            )
            ->map(static fn (Path $path) => $path->firstPosition)
            ->first($unit->position);

    }
}
