<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D24;

use App\Realms\Cartography\Path;
use App\Realms\Cartography\PathFinding;
use App\Realms\Cartography\Point;
use loophp\collection\Collection;
use RuntimeException;

final readonly class FastestRouteFinder
{
    private array $distances;

    public static function ofPoints(PathFinding $pathFinding, Point $start, Point ...$points): self
    {
        return new self($pathFinding, $start, $points);
    }

    private function __construct(PathFinding $pathFinding, private Point $start, private array $points)
    {
        $this->distances = DistanceCalculator::betweenEachPoint($pathFinding, $start, ...$points);
    }

    public function findFastestRoute(): Path
    {
        $possiblePaths = PossiblePaths::ofPoints($this->points);
        return Collection::fromGenerator($possiblePaths)
            ->map($this->convertSetToPath(...))
            ->sort(callback: Path::shortest(...))
            ->first();
    }

    private function convertSetToPath(array $points): Path
    {
        return Collection::fromIterable([$this->start, ...$points])
            ->window(1)
            ->reject(static fn (array $set) => count($set) === 1)
            ->map($this->findPathBetweenTwoPoints(...))
            ->reduce(Path::combine(...), Path::empty());
    }

    private function findPathBetweenTwoPoints(array $pair): Path
    {
        assert(2 === count($pair));
        [$alpha, $bravo] = $pair;
        return $this->distances[(string)$alpha][(string)$bravo]
            ?? throw new RuntimeException("I don’t have a path calculated between $alpha and $bravo");
    }
}
