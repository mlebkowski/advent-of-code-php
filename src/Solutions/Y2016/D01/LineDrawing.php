<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D01;

final class LineDrawing
{
    public static function of(Point $point, ?Point $previous, ?Point $next): string
    {
        assert($previous || $next);

        if (null === $previous) {
            return self::starting($point, $next);
        }

        if (null === $next) {
            return self::ending($previous, $point);
        }

        $enter = $previous->orientationBetween($point);
        $exit = $next->orientationBetween($point);

        return match ([$enter, $exit]) {
            [Orientation::North, Orientation::East], [Orientation::East, Orientation::North] => '└',
            [Orientation::North, Orientation::South], [Orientation::South, Orientation::North] => '│',
            [Orientation::North, Orientation::West], [Orientation::West, Orientation::North] => '┘',
            [Orientation::South, Orientation::East], [Orientation::East, Orientation::South] => '┌',
            [Orientation::South, Orientation::West], [Orientation::West, Orientation::South] => '┐',
            [Orientation::East, Orientation::West], [Orientation::West, Orientation::East] => '─',
            default => '█',
        };
    }

    private static function starting(Point $point, Point $next): string
    {
        return match ($point->orientationBetween($next)) {
            Orientation::South => '╵',
            Orientation::West => '╶',
            Orientation::North => '╷',
            Orientation::East => '╴',
        };
    }

    private static function ending(Point $previous, Point $point): string
    {
        return match ($previous->orientationBetween($point)) {
            Orientation::South => '╷',
            Orientation::West => '╴',
            Orientation::North => '╵',
            Orientation::East => '╶',
        };
    }
}
