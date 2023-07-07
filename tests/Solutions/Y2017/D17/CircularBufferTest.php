<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D17;

use PHPUnit\Framework\TestCase;

final class CircularBufferTest extends TestCase
{
    public function test(): void
    {
        $sut = CircularBuffer::of(3);
        self::assertSame([0], $sut->iterate()->values());
        self::assertSame([0, 1], $sut->iterate()->values());
        self::assertSame([0, 2, 1], $sut->iterate()->values());
        self::assertSame([0, 2, 3, 1], $sut->iterate()->values());
        self::assertSame([0, 2, 4, 3, 1], $sut->iterate()->values());
        self::assertSame([0, 5, 2, 4, 3, 1], $sut->iterate()->values());
        self::assertSame([0, 5, 2, 4, 3, 6, 1], $sut->iterate()->values());
        self::assertSame([0, 5, 7, 2, 4, 3, 6, 1], $sut->iterate()->values());
        self::assertSame([0, 5, 7, 2, 4, 3, 8, 6, 1], $sut->iterate()->values());
        self::assertSame([0, 9, 5, 7, 2, 4, 3, 8, 6, 1], $sut->iterate()->values());
    }
}
