<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D19;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class AcrossRulesTest extends TestCase
{
    #[DataProviderExternal(AcrossRulesDataProvider::class, 'data')]
    public function test(int $numberOfElves, int $expected): void
    {
        self::assertSame($expected, AcrossRules::of($numberOfElves));
    }
}
