<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D01;

use App\Solutions\Y2016\D01\Input\Instruction;

final class Path
{
    public readonly string $map;
    public readonly Point $firstIntersection;
    public readonly Point $lastPosition;

    public static function of(Instruction ...$instructions): self
    {
        $position = Point::center();
        $orientation = Orientation::North;
        $path = [];
        foreach ($instructions as $instruction) {
            $orientation = $orientation->turn($instruction->turn);
            for ($step = 0; $step < $instruction->distance; $step++) {
                $position = Point::of(
                    $position->x + $orientation->xMultiplier(),
                    $position->y + $orientation->yMultiplier(),
                );

                $path[] = $position;
            }
        }

        return new self(...$path);
    }

    public function __construct(Point ...$points)
    {
        $minX = array_reduce($points, static fn (int $minX, Point $p) => min($minX, $p->x), 0);
        $minY = array_reduce($points, static fn (int $minY, Point $p) => min($minY, $p->y), 0);
        $maxX = array_reduce($points, static fn (int $maxX, Point $p) => max($maxX, $p->x), 0);
        $maxY = array_reduce($points, static fn (int $maxY, Point $p) => max($maxY, $p->y), 0);

        $width = $maxX - $minX + 1;
        $height = $maxY - $minY + 1;
        $offset = Point::of($minX, $minY);

        $map = array_fill(0, $height, str_repeat(' ', $width));
        $center = Point::center()->offset($offset);
        $map[$center->y][$center->x] = '@';
        foreach ($points as $point) {
            $dot = $point->offset($offset);
            if (" " !== $map[$dot->y][$dot->x] && false === isset($this->firstIntersection)) {
                $this->firstIntersection = $point;
                $map[$dot->y][$dot->x] = '*';
            } else {
                $map[$dot->y][$dot->x] = '#';
            }
        }
        $this->lastPosition = end($points);
        $this->map = implode("\n", $map);
    }
}
