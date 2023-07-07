<?php
declare(strict_types=1);

namespace App\Realms\Cartography;

use Closure;
use loophp\collection\Collection;
use Stringable;

final readonly class Map implements Stringable
{
    public int $height;

    public static function fromString(string $map): self
    {
        $rows = explode("\n", $map);
        $widths = Collection::fromIterable($rows)
            ->map(static fn (string $row) => strlen($row))
            ->distinct()
            ->all();
        assert(1 === count($widths));
        return self::ofPoints(str_split(strtr($map, ["\n" => ""])), $widths[0]);
    }

    public static function ofPoints(array $map, int $width): self
    {
        return new self($map, $width);
    }

    private function __construct(private array $map, public int $width)
    {
        assert(count($map) % $this->width === 0);
        $this->height = (int)(count($map) / $this->width);
    }

    public function toPathFinding(string ...$blocked): PathFinding
    {
        return PathFinding::of(
            Collection::fromIterable($this->map)
                ->map(static fn (string $char) => in_array($char, $blocked, true))
                ->all(),
            $this->width,
        );
    }

    public function overlayPath(Path $path): self
    {
        return $this->overlay($path->toMap(), $path->area()->minCorner);
    }

    public function overlay(Map $other, Point $offset): self
    {
        assert($offset->x >= 0 && $offset->y >= 0);
        assert($this->width >= $other->width + $offset->x);
        assert($this->height >= $other->height + $offset->y);
        $overlay = Collection::fromIterable($other->map)
            ->reject(static fn (string $value) => $value === ' ')
            ->map(fn (string $value, int $idx) => [
                $idx
                + $this->width * $offset->y + $offset->x
                + floor($idx / $other->width) * ($this->width - $other->width),
                $value,
            ])
            ->unpack()
            ->all(false);

        return self::ofPoints(array_replace($this->map, $overlay), $this->width);
    }

    public function cutOut(Area $area): Map
    {
        return self::ofPoints(
            $this->withCoordinates()
                ->filter(static fn (string $value, Point $point) => $area->contains($point))
                ->all(),
            $area->width() + 1,
        );
    }

    public function withCoordinates(): Collection
    {
        return Collection::fromIterable($this->map)
            ->map(
                fn (string $value, int $idx) => [
                    Point::of(
                        x: $idx % $this->width,
                        y: (int)floor($idx / $this->width),
                    ),
                    $value,
                ],
            )
            ->unpack();
    }

    public function framed(): self
    {
        $area = Area::covering(Point::center(), $this->withCoordinates()->keys()->last());
        $path = Path::aroundArea($area);
        return $path->toMap()->overlay($this, Point::of(x: 1, y: 1));
    }

    public function withBoxDrawing(): string
    {
        return strtr((string)$this, ['.' => ' ', '#' => '█']);
    }

    public function apply(Closure $fn): self
    {
        return self::ofPoints(array_map($fn, $this->map), $this->width);
    }

    public function __toString(): string
    {
        return Collection::fromIterable($this->map)
            ->chunk($this->width)
            ->map(static fn (array $row) => implode('', $row))
            ->implode("\n");
    }
}
