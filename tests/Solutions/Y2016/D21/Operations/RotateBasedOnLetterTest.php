<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class RotateBasedOnLetterTest extends TestCase
{
    public static function data(): iterable
    {
        yield ['abcdefgh', 'a', 'habcdefg'];
        yield ['abcdefgh', 'b', 'ghabcdef'];
        yield ['abcdefgh', 'c', 'fghabcde'];
        yield ['abcdefgh', 'd', 'efghabcd'];
        yield ['abcdefgh', 'e', 'cdefghab'];
        yield ['abcdefgh', 'f', 'bcdefgha'];
        yield ['abcdefgh', 'g', 'abcdefgh'];
        yield ['abcdefgh', 'h', 'habcdefg'];
    }

    #[DataProvider('data')]
    public function test(string $plain, string $letter, string $scrambled): void
    {
        $sut = RotateBasedOnLetter::of($letter);
        self::assertSame($scrambled, $sut->scramble($plain));
        self::assertSame($plain, $sut->reverse($scrambled));
    }
}
