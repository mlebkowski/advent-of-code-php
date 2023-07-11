<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D01;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class LoopDetectorTest extends TestCase
{
    public static function data(): iterable
    {
        yield [[+1, -1], 0, 2, 0];
        yield [[+3, +3, +4, -2, -4], 3, 4, 10];
        yield [[-6, +3, +8, +5, -6], 3, 9, 5];
        yield [[+7, +7, -2, -7, -4], 2, 11, 14];
    }

    #[DataProvider('data')]
    public function test(array $sequence, int $index, int $length, int $expected): void
    {
        $actual = LoopDetector::detect($sequence);
        self::assertSame($index, $actual->index);
        self::assertSame($length, $actual->length);
        $sequence = FrequencySequence::ofChanges($sequence);

        $nth = $sequence->nth($actual->index);
        $next = $sequence->nth($actual->index + $actual->length);
        self::assertSame($expected, $nth);
        self::assertSame($nth, $next);

    }
}
