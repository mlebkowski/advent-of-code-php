<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

use App\Realms\Cartography\Point;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class FuelCellTest extends TestCase
{
    public static function data(): iterable
    {
        yield [3, 5, 8, 4];
        yield [122, 79, 57, -5];
        yield [217, 196, 39, 0];
        yield [101, 153, 71, 4];

    }

    #[DataProvider('data')]
    public function test power level(int $x, int $y, int $serial, int $expected): void
    {
        $actual = FuelCell::powerLevel(Point::of($x, $y), $serial);
        self::assertSame($expected, $actual);
    }
}
