<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D17;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class CircularBufferSimulatorTest extends TestCase
{
    public static function data(): iterable
    {
        yield [1];
        yield [2];
        yield [3];
        yield [4];
        yield [5];
        yield [6];
        yield [7];
        yield [8];
        yield [9];
        yield [10];
    }

    #[DataProvider('data')]
    public function test(int $step): void
    {
        $real = CircularBuffer::of($step);
        $sut = CircularBuffer::simulate($step);

        while ($sut->count() < 2018) {
            $sut->iterate();
            while (count($real->values()) < $sut->count()) {
                $real->iterate();
            }

            self::assertSame($real->position(), $sut->position());
            self::assertSame($real->values()[1] ?? null, $sut->secondValue());
        }
    }
}
