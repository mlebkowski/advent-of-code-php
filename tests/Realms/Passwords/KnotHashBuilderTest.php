<?php
declare(strict_types=1);

namespace App\Realms\Passwords;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class KnotHashBuilderTest extends TestCase
{
    public static function data(): iterable
    {
        yield ['', 'a2582a3a0e66e6e86e3812dcb672a272'];
        yield ['AoC 2017', '33efeb34ea91902bb2f59c9920caa6cd'];
        yield ['1,2,3', '3efbe78a8d82f29979031a4aa0b16a9d'];
        yield ['1,2,4', '63960835bcdc130f0b66d7ff4f6a5a8e'];
    }

    #[DataProvider('data')]
    public function test dense hash(string $input, string $expected): void
    {
        $sut = KnotHashBuilder::standard();
        $actual = $sut->build($input);
        self::assertSame($expected, $actual->denseHash);
    }
}
