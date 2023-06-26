<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D09;

final class DecompressorDataProvider
{
    public static function v1(): iterable
    {
        yield ['ADVENT', 'ADVENT'];
        yield ['A(1x5)BC', 'ABBBBBC'];
        yield ['(3x3)XYZ', 'XYZXYZXYZ'];
        yield ['A(2x2)BCD(2x2)EFG', 'ABCBCDEFEFG'];
        yield ['(6x1)(1x3)A', '(1x3)A'];
        yield ['X(8x2)(3x3)ABCY', 'X(3x3)ABC(3x3)ABCY'];
    }

    public static function v2(): iterable
    {
        yield ['(3x3)XYZ', 9];
        yield ['(27x12)(20x12)(13x14)(7x10)(1x12)A', 241920];
        yield ['(25x3)(3x3)ABC(2x3)XY(5x2)PQRSTX(18x9)(3x2)TWO(5x7)SEVEN', 445];
    }
}
