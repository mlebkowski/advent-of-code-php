<?php
declare(strict_types=1);

namespace App\Realms\Cartography\BoxDrawing;

use App\Realms\Cartography\Orientation;
use RuntimeException;

enum Line: string
{
    case Vertical = '│';
    case HalfTop = '╵';
    case HalfRight = '╶';
    case HalfBottom = '╷';
    case HalfLeft = '╴';
    case Horizontal = '─';
    case Intersection = '┼';
    case CornerTopLeft = '┌';
    case CornerTopRight = '┐';
    case CornerBottomLeft = '└';
    case CornerBottomRight = '┘';

    public function followDirection(Orientation $enter): Orientation
    {
        $exits = $this->exists();
        $index = array_search($enter->opposite(), $exits, true);
        if (false === $index) {
            throw new RuntimeException("You cannot approach '$this->value' from $enter->name");
        }

        unset($exits[$index]);
        if ([] === $exits) {
            throw new RuntimeException("$this->value is a cul-de-sac and has no exits");
        }
        if (in_array($enter, $exits, true)) {
            // prefer not to turn on intersections:
            return $enter;
        }
        return reset($exits);
    }

    /** @return Orientation[] */
    private function exists(): array
    {
        return match ($this) {
            self::Vertical => [Orientation::North, Orientation::South],
            self::HalfTop => [Orientation::North],
            self::HalfRight => [Orientation::East],
            self::HalfBottom => [Orientation::South],
            self::HalfLeft => [Orientation::West],
            self::Horizontal => [Orientation::West, Orientation::East],
            self::Intersection => [Orientation::West, Orientation::East, Orientation::South, Orientation::North],
            self::CornerTopLeft => [Orientation::South, Orientation::East],
            self::CornerTopRight => [Orientation::South, Orientation::West],
            self::CornerBottomLeft => [Orientation::North, Orientation::East],
            self::CornerBottomRight => [Orientation::North, Orientation::West],
        };
    }
}
