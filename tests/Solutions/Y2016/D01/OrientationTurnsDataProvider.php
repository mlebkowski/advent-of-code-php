<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D01;

final class OrientationTurnsDataProvider
{
    public static function turns(): iterable
    {
        yield [Orientation::North, Turn::Left, Orientation::West];
        yield [Orientation::East, Turn::Left, Orientation::North];
        yield [Orientation::South, Turn::Left, Orientation::East];
        yield [Orientation::West, Turn::Left, Orientation::South];
        yield [Orientation::North, Turn::Right, Orientation::East];
        yield [Orientation::East, Turn::Right, Orientation::South];
        yield [Orientation::South, Turn::Right, Orientation::West];
        yield [Orientation::West, Turn::Right, Orientation::North];
    }
}
