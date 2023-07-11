<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D02;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class IdTest extends TestCase
{
    public static function data()
    {
        yield ['abcdef', 2, false];
        yield ['abcdef', 3, false];

        yield ['bababc', 2, true];
        yield ['bababc', 3, true];

        yield ['abbcde', 2, true];
        yield ['abbcde', 3, false];

        yield ['abcccd', 2, false];
        yield ['abcccd', 3, true];

        yield ['aabcdd', 2, true];
        yield ['aabcdd', 3, false];

        yield ['abcdee', 2, true];
        yield ['abcdee', 3, false];

        yield ['ababab', 2, false];
        yield ['ababab', 3, true];
    }

    #[DataProvider('data')]
    public function test has exactly n of any letter(string $id, int $n, bool $expected): void
    {
        self::assertSame($expected, Id::of($id)->hasExactlyNumberOfAnyLetter($n));
    }
}
