<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class SwapLettersTest extends TestCase
{
    public static function data()
    {
        yield ['abc', 'a', 'c', 'cba'];
        yield ['abcde', 'd', 'e', 'abced'];
    }

    #[DataProvider('data')]
    public function test(string $plain, string $alpha, string $bravo, string $scrambled): void
    {
        $sut = SwapLetters::of($alpha, $bravo);
        self::assertSame($scrambled, $sut->scramble($plain));
        self::assertSame($plain, $sut->reverse($scrambled));
    }
}
