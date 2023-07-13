<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D14;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ScoreCounterTest extends TestCase
{
    public static function data(): iterable
    {
        yield [5, '0124515891'];
        yield [9, '5158916779'];
        yield [18, '9251071085'];
        yield [2018, '5941429882'];
    }

    #[DataProvider('data')]
    public function test(int $after, string $expected)
    {
        $sut = ScoreCounter::of(2, [3, 7]);
        $actual = $sut->count($after);
        self::assertSame($expected, $actual);
    }
}
