<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D15;

use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;
use PHPUnit\Framework\TestCase;

final class BattlegroundFactoryTest extends TestCase
{
    public function test create(): void
    {
        $given = Map::fromString(trim(file_get_contents(__DIR__ . '/map.txt')));
        $actual = BattlegroundFactory::create($given);
        self::assertEquals(
            [
                Unit::of(Point::of(10, 2), Faction::Goblins),
                Unit::of(Point::of(12, 2), Faction::Goblins),
                Unit::of(Point::of(13, 2), Faction::Goblins),
                Unit::of(Point::of(14, 4), Faction::Goblins),
                Unit::of(Point::of(7, 5), Faction::Goblins),
                Unit::of(Point::of(4, 6), Faction::Goblins),
                Unit::of(Point::of(10, 6), Faction::Goblins),
                Unit::of(Point::of(2, 9), Faction::Goblins),
                Unit::of(Point::of(5, 9), Faction::Goblins),
                Unit::of(Point::of(16, 9), Faction::Elves),
                Unit::of(Point::of(18, 9), Faction::Goblins),
            ],
            $actual->units(),
        );
    }
}
