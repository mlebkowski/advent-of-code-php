<?php
declare(strict_types=1);

namespace App\Realms\Cartography;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class OrientationTest extends TestCase
{
    #[DataProviderExternal(OrientationTurnsDataProvider::class, 'turns')]
    public function test(Orientation $sut, Turn $given, Orientation $expected): void
    {
        self::assertSame($expected, $sut->turn($given));
    }
}
