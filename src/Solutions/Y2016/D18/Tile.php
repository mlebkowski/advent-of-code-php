<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D18;

enum Tile: string
{
    case Safe = '.';
    case Trap = '^';

    public static function fromNeighbours(Row $tiles): self
    {
        assert(3 === $tiles->width());

        return match ((string)$tiles) {
            '^^.', '.^^', '^..', '..^' => self::Trap,
            default => self::Safe,
        };
    }

    public function isSafe(): bool
    {
        return self::Safe === $this;
    }
}
