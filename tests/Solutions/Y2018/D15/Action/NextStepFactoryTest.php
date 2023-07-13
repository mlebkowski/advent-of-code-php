<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D15\Action;

use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;
use App\Solutions\Y2018\D15\BattlegroundFactory;
use App\Solutions\Y2018\D15\Faction;
use App\Solutions\Y2018\D15\Unit;
use loophp\collection\Collection;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class NextStepFactoryTest extends TestCase
{
    public static function data(): iterable
    {
        yield [
            <<<MAP
            #######
            #E..G.#
            #...#.#
            #.G.#G#
            #######
            MAP,
            Point::of(2, 1),
            Point::of(3, 1),
        ];
        yield [
            <<<MAP
            ########
            #E...G.#
            #....#.#
            #.G..#G#
            ########
            MAP,
            Point::of(2, 1),
            Point::of(2, 2),
        ];

        yield [
            <<<MAP
            .G.....G.
            ....E....
            .G.....G.
            MAP,
            Point::of(4, 0),
            Point::of(3, 0),
            Point::of(2, 0),
        ];

        yield [
            <<<MAP
            .G..#..G.
            ...#E#...
            .G..#..G.
            MAP,
            Point::of(4, 1),
        ];
        yield [
            <<<MAP
            .G..G..G.
            ....E....
            .G.....G.
            MAP,
            Point::of(4, 1),
        ];
        yield [
            <<<MAP
            .EEEG.
            MAP,
            Point::of(1, 0),
        ];
        yield [
            <<<MAP
            .EEEG.
            ......
            MAP,
            Point::of(1, 1),
            Point::of(2, 1),
            Point::of(3, 1),
            Point::of(4, 1),
        ];

        yield [
            <<<MAP
            .E#.G.
            ......
            MAP,
            Point::of(1, 1),
            Point::of(2, 1),
            Point::of(3, 1),
            Point::of(3, 0),
        ];
    }

    #[DataProvider('data')]
    public function test(string $map, Point ...$points): void
    {
        $battleground = BattlegroundFactory::create(Map::fromString($map));
        /** @var Unit $unit */
        $unit = Collection::fromIterable($battleground->units())
            ->filter(static fn (Unit $unit) => $unit->faction === Faction::Elves)
            ->first();

        while ($expected = array_shift($points)) {
            $unit->turn($battleground);
            self::assertEquals($expected, $unit->position);
        }
    }
}
