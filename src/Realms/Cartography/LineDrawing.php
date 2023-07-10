<?php
declare(strict_types=1);

namespace App\Realms\Cartography;

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
            [Orientation::South, Orientation::East], [Orientation::West, Orientation::North] => '└',
            [Orientation::North, Orientation::North], [Orientation::South, Orientation::South] => '│',
            [Orientation::South, Orientation::West], [Orientation::East, Orientation::North] => '┘',
            [Orientation::North, Orientation::East], [Orientation::West, Orientation::South] => '┌',
            [Orientation::North, Orientation::West], [Orientation::East, Orientation::South] => '┐',
            [Orientation::East, Orientation::East], [Orientation::West, Orientation::West] => '─',
            default => '█',
        };
    }

    private static function starting(Point $point, Point $next): string
    {
        return match ($point->orientationBetween($next)) {
            Orientation::North => '╵',
            Orientation::East => '╶',
            Orientation::South => '╷',
            Orientation::West => '╴',
        };
    }

    private static function ending(Point $previous, Point $point): string
    {
        return match ($previous->orientationBetween($point)) {
            Orientation::North => '╷',
            Orientation::East => '╴',
            Orientation::South => '╵',
            Orientation::West => '╶',
        };
    }
}
