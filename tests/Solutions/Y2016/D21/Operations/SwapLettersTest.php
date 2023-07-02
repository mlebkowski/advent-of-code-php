<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use PHPUnit\Framework\TestCase;

final class SwapLettersTest extends TestCase
{
    public function test(): void
    {
        self::assertSame('cba', SwapLetters::of('a', 'c')->apply('abc'));
        self::assertSame('abcde', SwapLetters::of('d', 'e')->apply('abced'));
    }
}
