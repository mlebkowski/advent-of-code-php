<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use PHPUnit\Framework\TestCase;

final class RotateRightTest extends TestCase
{
    public function test(): void
    {
        self::assertSame('dabc', RotateRight::of(1)->apply('abcd'));
        self::assertSame('dabc', RotateRight::of(5)->apply('abcd'));
        self::assertSame('cdab', RotateRight::of(2)->apply('abcd'));
    }
}
