<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D01;

enum Orientation
{
    case North;
    case East;
    case South;
    case West;

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

    public function xMultiplier(): int
    {
        return match ($this) {
            self::North, self::South => 0,
            self::East => 1,
            self::West => -1,
        };
    }

    public function yMultiplier(): int
    {
        return match ($this) {
            self::East, self::West => 0,
            self::North => 1,
            self::South => -1,
        };
    }
}
