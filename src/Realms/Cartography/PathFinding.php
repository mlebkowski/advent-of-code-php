<?php
declare(strict_types=1);

namespace App\Realms\Cartography;

use App\Realms\Cartography\Problems\CannotFindPath;
use BlackScorp\Astar\Astar;
use BlackScorp\Astar\Grid;
use BlackScorp\Astar\Node;
use loophp\collection\Collection;

final readonly class PathFinding
{
    private const Blocked = 1000;

    public static function of(array $points, int $width): self
    {
        return new self(
            Collection::fromIterable($points)
                ->map(static fn (bool $state) => $state ? self::Blocked : 1)
                ->chunk($width)
                ->all(),
        );
    }

    private function __construct(private array $points)
    {
    }

    /**
     * @throws CannotFindPath
     */
    public function getPath(Point $from, Point $to): Path
    {
        $grid = new Grid($this->points);
        $astar = new Astar($grid);
        $astar->blocked([self::Blocked]);

        $startPosition = $grid->getPoint(y: $from->y, x: $from->x);
        $endPosition = $grid->getPoint(y: $to->y, x: $to->x);

        $path = $astar->search($startPosition, $endPosition);
        CannotFindPath::whenResultIsEmpty($path, $from, $to);

        return new Path(
            Collection::fromIterable($path)
                ->map(static fn (Node $node) => Point::of($node->getX(), $node->getY()))
                ->all(),
        );
    }

    public function tryGetPath(Point $from, Point $to): ?Path
    {
        try {
            return $this->getPath($from, $to);
        } catch (CannotFindPath) {
            return null;
        }
    }
}
