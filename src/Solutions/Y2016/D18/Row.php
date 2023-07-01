<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D18;

use loophp\collection\Collection;
use Stringable;

final readonly class Row implements Stringable
{
    public static function fromString(string $row): self
    {
        $tiles = Collection::fromString(trim($row))
            ->map(static fn (string $tile) => Tile::from($tile))
            ->all();

        return self::of(...$tiles);
    }

    public static function of(Tile ...$tiles): self
    {
        return new self($tiles);
    }

    private function __construct(public array $tiles)
    {
    }

    public function next(): Row
    {
        return self::of(
            ...
            Collection::fromIterable($this->tiles)
                ->prepend(Tile::Safe)
                ->append(Tile::Safe)
                ->window(2)
                ->filter(static fn (array $tiles) => count($tiles) === 3)
                ->map(static fn (array $tiles) => Tile::fromNeighbours(self::of(...$tiles)))
                ->all(),
        );
    }

    public function safeTileCount(): int
    {
        return Collection::fromIterable($this->tiles)
            ->filter(static fn (Tile $tile) => $tile->isSafe())
            ->count();
    }

    public function width(): int
    {
        return count($this->tiles);
    }

    public function __toString(): string
    {
        return Collection::fromIterable($this->tiles)
            ->map(static fn (Tile $tile) => $tile->value)
            ->implode();
    }
}
