<?php
declare(strict_types=1);

namespace App\Realms\Cartography;

enum Orientation
{
    case North;
    case East;
    case South;
    case West;

    public function isHorizontal(): bool
    {
        return in_array($this, [self::East, self::West], true);
    }

    public function isVertical(): bool
    {
        return in_array($this, [self::South, self::North], true);
    }

    public function turn(Turn $direction): self
    {
        $orientations = self::cases();
        $offset = match ($direction) {
            Turn::Left => -1,
            Turn::Right => 1,
        };

        $index = count($orientations) + array_search($this, $orientations, true) + $offset;
        return $orientations[$index % count($orientations)];
    }

    public function opposite(): self
    {
        return match ($this) {
            self::North => self::South,
            self::East => self::West,
            self::South => self::North,
            self::West => self::East,
        };
    }

    public function xDirection(): int
    {
        return match ($this) {
            self::North, self::South => 0,
            self::East => 1,
            self::West => -1,
        };
    }

    public function yDirection(): int
    {
        return match ($this) {
            self::East, self::West => 0,
            self::South => 1,
            self::North => -1,
        };
    }

    public function perpendicular(): array
    {
        return match ($this) {
            self::East, self::West => [self::North, self::South],
            self::North, self::South => [self::East, self::West],
        };
    }
}
