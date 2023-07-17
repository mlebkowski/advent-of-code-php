<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D18;

use App\Lib\Type\Cast;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;
use loophp\collection\Collection;

final readonly class ConstructionProject
{
    public static function ofMap(Map $map): self
    {
        return new self(
            $map->withCoordinates()
                ->map(static fn (string $acre, Point $point) => [(string)$point, Acre::from($acre)])
                ->unpack()
                ->all(false),
        );
    }

    private function __construct(private array $acres)
    {
    }

    public function step(): self
    {
        return new self(
            Collection::fromIterable($this->acres)
                ->map(fn (Acre $acre, string $point) => $acre->convert(
                    $this->countAdjacent(Point::fromString($point)),
                ))
                ->all(false),
        );
    }

    public function toMap(int $width): Map
    {
        return Map::ofPoints(
            array_map(Cast::toEnumValue(...), $this->acres),
            $width,
        );
    }

    public function resourceValue(): int
    {
        $values = Collection::fromIterable($this->acres)
            ->filter()
            ->frequency()
            ->map(Cast::toEnumValue(...))
            ->flip()
            ->all(false);

        return $values[Acre::Trees->value] * $values[Acre::Lumberyard->value];
    }

    private function at(Point $point): ?Acre
    {
        return $this->acres[(string)$point] ?? null;
    }

    private function countAdjacent(Point $point): array
    {
        return Collection::fromIterable($point->adjacent())
            ->map($this->at(...))
            ->filter()
            ->frequency()
            ->map(Cast::toEnumValue(...))
            ->flip()
            ->all(false);
    }
}
