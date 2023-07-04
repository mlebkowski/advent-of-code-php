<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class GroupBuilderTest extends TestCase
{
    public static function data(): iterable
    {
        yield [0 => [], '{}'];
        yield [0 => [[[]]], '{{{}}}'];
        yield [0 => [[], []], '{{},{}}'];
        yield [0 => [[[], [], [[]]]], '{{{},{},{{}}}}'];
    }

    #[DataProvider('data')]
    public function test(array $input, string $expected): void
    {
        $sut = GroupBuilder::of(...);
        $actual = $sut($input);
        self::assertSame($expected, (string)$actual);
    }
}
