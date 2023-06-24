<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D01;

use loophp\collection\Collection;
use Stringable;

final readonly class Map implements Stringable
{
    public static function ofPath(Path $path): self
    {
        $area = Area::covering(...$path->points);

        $width = $area->width() + 1;
        $height = $area->height() + 1;
        $offset = $area->minCorner;

        $map = array_fill(0, $height * $width, ' ');
        foreach ($path->points as $idx => $point) {
            $dot = $point->offset($offset);
            $map[$dot->y * $width + $dot->x] = LineDrawing::of(
                point: $point,
                previous: $path->points[$idx - 1] ?? null,
                next: $path->points[$idx + 1] ?? null,
            );
        }

        $map = Collection::fromIterable($map)
            ->chunk($width)
            ->map(static fn (array $row) => implode('', $row))
            ->implode("\n");

        return new self($map);
    }

    private function __construct(private string $map)
    {
    }

    public function __toString(): string
    {
        return $this->map;
    }
}
