<?php
declare(strict_types=1);

namespace App\Solutions\Y2015\D25;

final class CodeGenerator
{
    public static function at(int $row, int $column): int
    {
        $n = TriangularNumber::for($row + $column - 1) - $row;
        return self::nth($n);
    }

    public static function nth(int $n): int
    {
        for ($code = 20151125, $k = 0; $k < $n; $k++) {
            $code = ($code * 252533) % 33554393;
        }
        return $code;
    }
}
