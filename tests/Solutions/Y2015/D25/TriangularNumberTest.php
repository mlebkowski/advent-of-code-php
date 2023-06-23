<?php
declare(strict_types=1);

namespace App\Solutions\Y2015\D25;

use PHPUnit\Framework\TestCase;

final class TriangularNumberTest extends TestCase
{
    public function test for(): void
    {
        self::assertSame(1, TriangularNumber::for(1));
        self::assertSame(3, TriangularNumber::for(2));
        self::assertSame(6, TriangularNumber::for(3));
        self::assertSame(10, TriangularNumber::for(4));
        self::assertSame(15, TriangularNumber::for(5));
        self::assertSame(21, TriangularNumber::for(6));
        self::assertSame(28, TriangularNumber::for(7));
        self::assertSame(36, TriangularNumber::for(8));
        self::assertSame(45, TriangularNumber::for(9));
    }
}
