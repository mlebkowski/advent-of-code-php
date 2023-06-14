<?php

declare(strict_types=1);

namespace Solutions\Y2015\D15;

use App\Solutions\Y2015\D15\Ingredient;
use App\Solutions\Y2015\D15\ScoreCounter;
use PHPUnit\Framework\TestCase;

final class ScoreCounterTest extends TestCase
{
    public function test calculate score(): void
    {
        $sut = new ScoreCounter([
            new Ingredient(1, -1, 7, 4, 5),
            new Ingredient(2, 1, -2, 2, 1),
        ]);

        $stCount = 1;
        $ndCount = 2;
        $actual = $sut->calculateScore([$stCount, $ndCount]);

        self::assertSame(
            ($stCount * 1 + $ndCount * 2)
            * ($stCount * -1 + $ndCount * 1)
            * ($stCount * 7 + $ndCount * -2)
            * ($stCount * 4 + $ndCount * 2),
            $actual->score,
        );

        self::assertSame($stCount * 5 + $ndCount * 1, $actual->calories);
    }
}
