<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use PHPUnit\Framework\TestCase;

final class RotateBasedOnLetterTest extends TestCase
{
    public function test(): void
    {
        self::assertSame('eabcd', RotateBasedOnLetter::of('a')->apply('abcde'));
        self::assertSame('deabc', RotateBasedOnLetter::of('b')->apply('abcde'));
        self::assertSame('cdeab', RotateBasedOnLetter::of('c')->apply('abcde'));
        self::assertSame('bcdea', RotateBasedOnLetter::of('d')->apply('abcde'));
        self::assertSame('eabcd', RotateBasedOnLetter::of('e')->apply('abcde'));
    }
}
