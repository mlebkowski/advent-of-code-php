<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D24;

use PHPUnit\Framework\TestCase;

final class PossiblePathsTest extends TestCase
{
    public function test(): void
    {
        $given = [1, 2, 3];
        $sut = PossiblePaths::ofPoints(...);
        $actual = iterator_to_array($sut($given));
        self::assertSame(
            [[1, 2, 3], [1, 3, 2], [2, 1, 3], [2, 3, 1], [3, 1, 2], [3, 2, 1]],
            $actual,
        );
    }
}
