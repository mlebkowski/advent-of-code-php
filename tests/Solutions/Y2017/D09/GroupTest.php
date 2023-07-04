<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class GroupTest extends TestCase
{
    public static function data()
    {
        yield [0 => [], 1];
        yield [0 => [[[]]], 6];
        yield [0 => [[], []], 5];
        yield [0 => [[[], [], [[]]]], 16];
        yield [0 => [[], [], [], []], 9];
        yield [0 => [[]], 3];
    }

    #[DataProvider('data')]
    public function test(array $input, int $score): void
    {
        $sut = GroupBuilder::of($input);
        $actual = $sut->score();
        self::assertSame($score, $actual);
    }
}
