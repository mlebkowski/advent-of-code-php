<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D16;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class DragonCurveGeneratorTest extends TestCase
{
    #[DataProviderExternal(DragonCurveDataProvider::class, 'data')]
    public function test(string $input, string $expected): void
    {
        $sut = DragonCurveGenerator::ofInitialState($input);
        self::assertSame($expected, $sut->current());
    }
}
