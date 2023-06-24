<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D04;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class RoomTest extends TestCase
{
    #[DataProviderExternal(RoomNamesDataProvider::class, 'roomNames')]
    public function test is valid(string $name, int $sectorId, string $checksum, bool $expected): void
    {
        $sut = Room::of($name, $sectorId, $checksum);
        self::assertSame($expected, $sut->isValid());
    }
}
