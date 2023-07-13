<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13;

use App\Realms\Cartography\Orientation;
use App\Realms\Cartography\Turn;

enum TurnPreference
{
    case Left;
    case Straight;
    case Right;

    public static function initial(): self
    {
        return self::Left;
    }

    public function next(): self
    {
        return match ($this) {
            self::Left => self::Straight,
            self::Straight => self::Right,
            self::Right => self::Left,
        };
    }

    public function getDirection(Orientation $orientation): Orientation
    {
        return match ($this) {
            self::Left => $orientation->turn(Turn::Left),
            self::Straight => $orientation,
            self::Right => $orientation->turn(Turn::Right),
        };
    }
}
