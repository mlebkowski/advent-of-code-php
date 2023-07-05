<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D11;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class StepCounterTest extends TestCase
{
    public static function data(): iterable
    {
        yield ['ne,ne,ne', 3];
        yield ['ne,ne,sw,sw', 0];
        yield ['ne,ne,s,s', 2];
        yield ['se,sw,se,sw,sw', 3];
    }

    #[DataProvider('data')]
    public function test(string $input, int $expected): void
    {
        $directions = (new HexEdInputParser())->parse($input)->directions;
        $sut = StepCounter::count(...$directions);
        iterator_to_array($sut);
        $actual = $sut->getReturn();
        self::assertSame($expected, $actual);
    }
}
