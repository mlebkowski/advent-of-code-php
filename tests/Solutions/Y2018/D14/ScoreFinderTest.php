<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D14;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ScoreFinderTest extends TestCase
{
    public static function data(): iterable
    {
        yield ['51589', 9];
        yield ['01245', 5];
        yield ['92510', 18];
        yield ['59414', 2018];
    }

    #[DataProvider('data')]
    public function test(string $scores, int $expected): void
    {
        $sut = ScoreFinder::of(2, [3, 7]);
        $actual = $sut->find($scores);
        self::assertSame($expected, $actual);
    }
}
