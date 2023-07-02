<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ReverseRangeTest extends TestCase
{
    public static function data(): iterable
    {
        yield ['abcde', 1, 3, 'adcbe'];
        yield ['abcde', 0, 4, 'edcba'];
    }

    #[DataProvider('data')]
    public function test(string $plain, int $start, int $end, string $scrambled): void
    {
        $sut = ReverseRange::of($start, $end);
        self::assertSame($scrambled, $sut->scramble($plain));
        self::assertSame($plain, $sut->reverse($scrambled));
    }
}
