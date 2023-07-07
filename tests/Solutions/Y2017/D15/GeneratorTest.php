<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D15;

use loophp\collection\Collection;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class GeneratorTest extends TestCase
{
    public static function data(): iterable
    {
        yield [GeneratorType::A, false, 65, [1092455, 1181022009, 245556042, 1744312007, 1352636452]];
        yield [GeneratorType::B, false, 8921, [430625591, 1233683848, 1431495498, 137874439, 285222916]];
        yield [GeneratorType::A, true, 65, [1352636452, 1992081072, 530830436, 1980017072, 740335192]];
        yield [GeneratorType::B, true, 8921, [1233683848, 862516352, 1159784568, 1616057672, 412269392]];
    }

    #[DataProvider('data')]
    public function test regular(GeneratorType $type, bool $picky, int $startingValue, array $expected): void
    {
        $sut = Generator::of($type, $startingValue);
        $actual = Collection::fromIterable($sut->generate($picky))->limit(count($expected))->all();
        self::assertSame($expected, $actual);
    }
}
