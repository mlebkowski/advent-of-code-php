<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class RotateLeftTest extends TestCase
{
    public static function data(): iterable
    {
        yield ['abcd', 1, 'bcda'];
        yield ['abcd', 5, 'bcda'];
        yield ['abcd', 2, 'cdab'];
    }

    #[DataProvider('data')]
    public function test(string $plain, int $steps, string $scrambled): void
    {
        $sut = RotateLeft::of($steps);
        self::assertSame($scrambled, $sut->scramble($plain));
        self::assertSame($plain, $sut->reverse($scrambled));
    }
}
