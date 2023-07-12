<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class SquareFinderTest extends TestCase
{
    public static function data(): iterable
    {
        yield [18, '33,45', 29];
        yield [42, '21,61', 30];
    }

    #[DataProvider('data')]
    public function test(int $serial, string $expectedId, int $expectedPower): void
    {
        ini_set('memory_limit', '1G');
        $actual = SquareFinder::of(300, 3, $serial);
        self::assertSame($expectedId, $actual->id);
        self::assertSame($expectedPower, $actual->totalPower());
    }
}
