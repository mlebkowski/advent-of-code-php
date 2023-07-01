<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D18;

use loophp\collection\Collection;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class RoomTest extends TestCase
{
    #[DataProviderExternal(RoomDataProvider::class, 'data')]
    public function test(string $expected, int $safeTiles): void
    {
        $lines = Collection::fromString($expected)->lines();
        $firstRow = Row::fromString($lines->first());
        $sut = Room::populateFromFirstRow($firstRow, $lines->count());
        $actual = (string)$sut;
        self::assertSame($expected, $actual);
        self::assertSame($safeTiles, $sut->safeTileCount());
    }
}
