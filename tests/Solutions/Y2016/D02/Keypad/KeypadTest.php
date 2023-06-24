<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D02\Keypad;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class KeypadTest extends TestCase
{
    #[DataProviderExternal(KeypadLayoutDataProvider::class, 'layouts')]
    public function test layout(string $layout, array $expected, array $startingPoint): void
    {
        $sut = Keypad::ofLayout($layout);
        self::assertSame($expected, $sut->layout);
        self::assertSame($startingPoint, $sut->cursor);
    }
}
