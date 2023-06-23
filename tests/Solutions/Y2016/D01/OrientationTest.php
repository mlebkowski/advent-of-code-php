<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D01;

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
