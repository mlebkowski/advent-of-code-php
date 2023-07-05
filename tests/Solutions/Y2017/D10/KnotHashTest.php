<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D10;

use App\Aoc\Challenge;
use App\Aoc\Part;
use App\Aoc\Runner\RunMode;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class KnotHashTest extends TestCase
{
    public static function data(): iterable
    {
        yield ['', 'a2582a3a0e66e6e86e3812dcb672a272'];
        yield ['AoC 2017', '33efeb34ea91902bb2f59c9920caa6cd'];
        yield ['1,2,3', '3efbe78a8d82f29979031a4aa0b16a9d'];
        yield ['1,2,4', '63960835bcdc130f0b66d7ff4f6a5a8e'];
    }

    #[DataProvider('data')]
    public function test dense hash(string $input, string $expected): void
    {
        $challenge = Challenge::of(2016, 10, Part::Two);
        $input = (new KnotHashInputParser())->parse($input);
        $sut = new KnotHash();
        $actual = $sut->solve($challenge, $input, RunMode::Actual);
        self::assertSame($expected, $actual);
    }
}
