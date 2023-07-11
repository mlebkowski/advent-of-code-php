<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D09;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
    public static function data(): iterable
    {
        yield [9, 25, 32];
        yield [10, 1618, 8317];
        yield [13, 7999, 146373];
        yield [17, 1104, 2764];
        yield [21, 6111, 54718];
        yield [30, 5807, 37305];
    }

    #[DataProvider('data')]
    public function test high score(int $players, int $lastMarble, int $expected)
    {
        $sut = Game::of($players);
        $actual = $sut->play($lastMarble);
        self::assertSame($expected, $actual);
    }
}
