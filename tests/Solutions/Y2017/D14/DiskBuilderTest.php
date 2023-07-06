<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D14;

use App\Realms\Cartography\Area;
use App\Realms\Cartography\Point;
use PHPUnit\Framework\TestCase;

final class DiskBuilderTest extends TestCase
{
    public function test from key string(): void
    {
        $given = 'flqrgnkx';
        $sut = DiskBuilder::fromKeyString($given);
        $actual = $sut->cutOut(Area::covering(Point::center(), Point::of(x: 7, y: 7)));
        self::assertSame(
            <<<EOF
            ##.#.#..
            .#.#.#.#
            ....#.#.
            #.#.##.#
            .##.#...
            ##..#..#
            .#...#..
            ##.#.##.
            EOF,
            (string)$actual,
        );
    }
}
