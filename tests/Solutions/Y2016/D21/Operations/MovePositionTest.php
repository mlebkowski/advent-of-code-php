<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class MovePositionTest extends TestCase
{
    public static function data(): iterable
    {
        yield ['abc', 0, 2, 'bca'];
        yield ['abc', 2, 0, 'cab'];
        yield ['abcd', 1, 2, 'acbd'];
        yield ['abcd', 1, 1, 'abcd'];
    }

    #[DataProvider('data')]
    public function test(string $plain, int $from, int $to, string $scrambled)
    {
        $sut = MovePosition::of($from, $to);
        self::assertSame($scrambled, $sut->scramble($plain));
        self::assertSame($plain, $sut->reverse($scrambled));
    }
}
