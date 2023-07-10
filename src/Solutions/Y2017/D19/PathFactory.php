<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D19;

use App\Realms\Cartography\LineSegment;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Orientation;
use App\Realms\Cartography\Path;
use App\Realms\Cartography\Point;
use loophp\collection\Collection;
use RuntimeException;

final readonly class PathFactory
{
    private const Vertical = '|';
    private const Horizontal = '-';
    private const Turn = '+';
    private Collection $points;
    private array $values;
    private Point $corner;

    public static function of(Map $map): self
    {
        return new self($map);
    }

    private function __construct(Map $map)
    {
        $this->points = $map->withCoordinates()->flip();
        $this->values = $this->points
            ->map(static fn (Point $point, string $value) => [(string)$point, $value])
            ->unpack()
            ->all(false);
        $this->corner = Point::of(x: $map->width - 1, y: $map->height - 1);
    }

    public function fromShittyLineDrawing(): Path
    {
        $start = $this->points->find(
            callbacks: static fn (Point $point, string $value) => $value === self::Vertical
                && $point->y === 0,
        );

        $path = [$start];

        $direction = Orientation::South;
        while (true) {
            $next = $this->findNextTurn($start, $direction);
            $path = [...$path, ...LineSegment::between($start, $next)->rest()];
            $start = $next;
            if (self::Turn !== $this->values[(string)$start]) {
                break;
            }
            $direction = $this->discoverContinuation($start, ...$direction->perpendicular());
        }

        return Path::ofPoints(...$path);
    }

    private function findNextTurn(Point $point, Orientation $direction): ?Point
    {
        $lastPoint = match ($direction) {
            Orientation::North => Point::of($point->x, 0),
            Orientation::East => Point::of($this->corner->x, $point->y),
            Orientation::South => Point::of($point->x, $this->corner->y),
            Orientation::West => Point::of(0, $point->y),
        };

        while (true) {
            $point = $point->inDirection($direction);
            $value = $this->values[(string)$point];
            if ($value === self::Turn || $point->equals($lastPoint)) {
                return $point;
            }

            if ($value === ' ') {
                $previous = $point->inDirection($direction->opposite());
                $value = $this->values[(string)$previous];
                if (ctype_upper($value)) {
                    return $previous;
                }
                throw new RuntimeException("Ooops, ran out of path at $point going $direction->name");
            }
        }
    }

    private function discoverContinuation(Point $point, Orientation ...$directions): ?Orientation
    {
        foreach ($directions as $candidate) {
            $next = $point->inDirection($candidate);
            $value = $this->values[(string)$next] ?? null;
            if (in_array($value, [self::Vertical, self::Horizontal], true) || ctype_upper($value)) {
                return $candidate;
            }
        }

        throw new RuntimeException(" Cant find path continuation @ $point");
    }
}
