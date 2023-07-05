<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D11;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class StepCounterTest extends TestCase
{
    public static function data(): iterable
    {
        yield ['ne,ne,ne', 3, 'ne,ne,ne'];
        yield ['ne,ne,sw,sw', 0, ''];
        yield ['ne,ne,s,s', 2, 'se,se'];
        yield ['se,sw,se,sw,sw', 3, 's,s,sw'];
    }

    #[DataProvider('data')]
    public function test(string $input, int $expected): void
    {
        $directions = (new HexEdInputParser())->parse($input)->directions;
        $actual = StepCounter::count(...$directions);
        self::assertSame($expected, $actual);
    }
}
