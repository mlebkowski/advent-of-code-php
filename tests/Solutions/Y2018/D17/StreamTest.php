<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D17;

use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class StreamTest extends TestCase
{
    #[DataProviderExternal(StreamDataProvider::class, 'data')]
    public function test(string $expected): void
    {
        $map = Map::fromString(str_replace('~', ' ', $expected));
        $sut = Stream::of($map, Point::of(intdiv($map->width, 2), 0));
        $points = iterator_to_array($sut, preserve_keys: false);
        $actual = $map->overlayPoints(
            array_map(
                static fn (Point $point) => [$point, '~'],
                $points,
            ),
        );

        self::assertSame($expected, (string)$actual);
    }
}
