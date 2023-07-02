<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use PHPUnit\Framework\TestCase;

final class SwapPositionsTest extends TestCase
{
    public function test(): void
    {
        self::assertSame('acb', SwapPositions::of(1, 2)->apply('abc'));
        self::assertSame('abc', SwapPositions::of(1, 1)->apply('abc'));
    }
}
