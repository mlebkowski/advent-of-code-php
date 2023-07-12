<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

final class SquareFinder
{
    public static function of(PowerGrid $grid, int $squareSize = null): Square
    {
        $sums = SummedAreaTable::of($grid->grid);
        $result = Square::of(0, 0, 0, -PHP_INT_MAX);

        $minSize = $squareSize ?? 1;
        $maxSize = $squareSize ?? PHP_INT_MAX;

        for ($y = 0; $y < $grid::Size; $y++) {
            for ($x = 0; $x < $grid::Size; $x++) {
                for ($size = $minSize; $size <= min($maxSize, $grid::Size - max($x, $y) - 1); $size++) {
                    $level = $sums->sum($x, $y, $size, $size);
                    if ($level > $result->powerlevel) {
                        $result = Square::of($x + 1, $y + 1, $size, $level);
                    }
                }
            }
        }
        return $result;
    }
}
