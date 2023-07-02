<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use PHPUnit\Framework\TestCase;

final class RotateLeftTest extends TestCase
{
    public function test(): void
    {
        self::assertSame('bcda', RotateLeft::of(1)->apply('abcd'));
        self::assertSame('bcda', RotateLeft::of(5)->apply('abcd'));
        self::assertSame('cdab', RotateLeft::of(2)->apply('abcd'));
    }
}
