<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class RotateRightTest extends TestCase
{
    public static function data()
    {
        yield ['abcd', 1, 'dabc'];
        yield ['abcd', 5, 'dabc'];
        yield ['abcd', 2, 'cdab'];
    }

    #[DataProvider('data')]
    public function test(string $plain, int $steps, string $scrambled): void
    {
        $sut = RotateRight::of($steps);
        self::assertSame($scrambled, $sut->scramble($plain));
        self::assertSame($plain, $sut->reverse($scrambled));
    }
}
