<?php
declare(strict_types=1);

namespace App\Realms\Cartography;

use App\Solutions\Y2016\D01\Instruction;
use loophp\collection\Collection;

final readonly class Path
{
    public Point $firstIntersection;
    public Point $lastPosition;

    public static function aroundArea(Area $area): self
    {
        $minCorner = $area->minCorner->inDirection(Orientation::West)->inDirection(Orientation::South);
        $maxCorner = $area->maxCorner->inDirection(Orientation::East)->inDirection(Orientation::North);
        $corners = [
            $minCorner,
            Point::of(x: $maxCorner->x, y: $minCorner->y),
            Point::of(x: $maxCorner->x, y: $maxCorner->y),
            Point::of(x: $minCorner->x, y: $maxCorner->y),
            $minCorner,
        ];

        $points = Collection::fromIterable($corners)
            ->window(1)
            ->reject(static fn (array $points) => 1 === count($points))
            ->flatMap(static fn (array $corners) => LineSegment::between(...$corners)->rest())
            ->prepend($minCorner) // path needs to overlap for it to be closed
            ->all();

        return new self($points, closed: true);
    }

    public static function ofInstructions(Instruction ...$instructions): self
    {
        $position = Point::center();
        $orientation = Orientation::North;
        $points = [];
        foreach ($instructions as $instruction) {
            $orientation = $orientation->turn($instruction->turn);
            $lineSegment = $position->lineSegment($orientation, $instruction->distance);
            $points = array_merge($points, $lineSegment->rest());
            $position = $lineSegment->end();
        }

        return new self($points);
    }

    public static function ofPoints(Point ...$points): self
    {
        return new self($points);
    }

    public static function empty(): self
    {
        return new self([]);
    }

    public static function combine(self $alpha, self $bravo): Path
    {
        if ($alpha->isEmpty()) {
            return $bravo;
        }
        if ($bravo->isEmpty()) {
            return $alpha;
        }

        assert($alpha->lastPosition->equals($bravo->points[0]));
        return Path::ofPoints(...$alpha->points, ...array_slice($bravo->points, 1));
    }

    public static function shortest(self $alpha, self $bravo): int
    {
        return $alpha->steps() <=> $bravo->steps();
    }

    private function __construct(public array $points, private bool $closed = false)
    {
        if (!$this->points) {
            return;
        }
        $places = [];
        foreach ($points as $point) {
            $key = (string)$point;
            if (isset($places[$key]) && false === isset($this->firstIntersection)) {
                $this->firstIntersection = $point;
            }
            $places[$key] = true;
        }
        $this->lastPosition = end($points);
        if ($this->closed) {
            assert($this->lastPosition->equals($this->points[0]));
        }
    }

    public function area(): Area
    {
        return Area::covering(...$this->points);
    }

    public function steps(): int
    {
        return count($this->points) - 1;
    }

    public function toMap(): Map
    {
        $area = $this->area();

        $width = $area->width() + 1;
        $height = $area->height() + 1;
        $offset = $area->minCorner;

        $map = array_fill(0, $height * $width, ' ');
        foreach ($this->points as $idx => $point) {
            $dot = $point->offset($offset);
            $map[$dot->y * $width + $dot->x] = LineDrawing::of(
                point: $point,
                previous: $this->points[$idx - 1] ?? null,
                next: $this->points[$idx + 1] ?? ($this->closed ? $this->points[1] : null),
            );
        }

        return Map::ofPoints($map, $width);
    }

    private function isEmpty(): bool
    {
        return 0 === count($this->points);
    }
}
