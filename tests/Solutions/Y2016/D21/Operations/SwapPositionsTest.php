<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class SwapPositionsTest extends TestCase
{
    public static function data(): iterable
    {
        yield ['abc', 1, 2, 'acb'];
        yield ['abc', 1, 1, 'abc'];
    }

    #[DataProvider('data')]
    public function test(string $plain, int $alpha, int $bravo, string $scrambled): void
    {
        $sut = SwapPositions::of($alpha, $bravo);
        self::assertSame($scrambled, $sut->scramble($plain));
        self::assertSame($plain, $sut->reverse($scrambled));
    }
}
