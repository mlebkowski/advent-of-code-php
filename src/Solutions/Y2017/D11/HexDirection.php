<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D11;

enum HexDirection: string
{
    case North = 'n';
    case NorthEast = 'ne';
    case SouthEast = 'se';
    case South = 's';
    case SouthWest = 'sw';
    case NorthWest = 'nw';

    public static function shortcuts(): iterable
    {
        yield self::North => [self::NorthWest, self::NorthEast];
        yield self::NorthEast => [self::North, self::SouthEast];
        yield self::SouthEast => [self::NorthEast, self::South];
        yield self::South => [self::SouthEast, self::SouthWest];
        yield self::SouthWest => [self::South, self::NorthWest];
        yield self::NorthWest => [self::SouthWest, self::North];
    }

    public function opposite(): self
    {
        return match ($this) {
            self::North => self::South,
            self::NorthEast => self::SouthWest,
            self::SouthEast => self::NorthWest,
            self::South => self::North,
            self::SouthWest => self::NorthEast,
            self::NorthWest => self::SouthEast,
        };
    }
}
