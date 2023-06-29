<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D16;

final class DragonCurveDataProvider
{
    public static function data(): iterable
    {
        yield ['1', '100'];
        yield ['0', '001'];
        yield ['11111', '11111000000'];
        yield ['111100001010', '1111000010100101011110000'];
    }
}
