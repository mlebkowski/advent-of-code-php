<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D03\Problems;

use Exception;

final class TooShortSides extends Exception
{
    public static function whenOneIsLongerThanTheOtherTwo(bool $isLonger, int ...$sides): void
    {
        $isLonger && throw new self(vsprintf('Cannot build a triangle with sides: %d, %d, %d', $sides));
    }
}
