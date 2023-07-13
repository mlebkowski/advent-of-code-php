<?php
declare(strict_types=1);

namespace App\Realms\Cartography;

use App\Realms\Cartography\BoxDrawing\Line;

final class LineDrawing
{
    public static function of(Point $point, ?Point $previous, ?Point $next): string
    {
        if (null === $previous && null === $next) {
            return '•';
        }

        if (null === $previous) {
            return self::starting($point, $next);
        }

        if (null === $next) {
            return self::ending($previous, $point);
        }

        $enter = $previous->orientationBetween($point);
        $exit = $point->orientationBetween($next);

        return match ([$enter, $exit]) {
            [Orientation::South, Orientation::East],
            [Orientation::West, Orientation::North] => Line::CornerBottomLeft->value,
            [Orientation::North, Orientation::North],
            [Orientation::South, Orientation::South] => Line::Vertical->value,
            [Orientation::South, Orientation::West],
            [Orientation::East, Orientation::North] => Line::CornerBottomRight->value,
            [Orientation::North, Orientation::East],
            [Orientation::West, Orientation::South] => Line::CornerTopLeft->value,
            [Orientation::North, Orientation::West],
            [Orientation::East, Orientation::South] => Line::CornerTopRight->value,
            [Orientation::East, Orientation::East],
            [Orientation::West, Orientation::West] => Line::Horizontal->value,
            default => '█',
        };
    }

    private static function starting(Point $point, Point $next): string
    {
        return match ($point->orientationBetween($next)) {
            Orientation::North => Line::HalfTop->value,
            Orientation::East => Line::HalfRight->value,
            Orientation::South => Line::HalfBottom->value,
            Orientation::West => Line::HalfLeft->value,
        };
    }

    private static function ending(Point $previous, Point $point): string
    {
        return match ($previous->orientationBetween($point)) {
            Orientation::North => Line::HalfBottom->value,
            Orientation::East => Line::HalfLeft->value,
            Orientation::South => Line::HalfTop->value,
            Orientation::West => Line::HalfRight->value,
        };
    }
}
