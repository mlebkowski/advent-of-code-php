<?php
declare(strict_types=1);

namespace App\Realms\Cartography;

use PHPUnit\Framework\TestCase;

final class MapTest extends TestCase
{
    public function test overlay(): void
    {
        $map = Map::ofPoints(array_fill(0, 35, '.'), width: 5);
        $given = Map::ofPoints(['┌', '┐', ' ', '│', '└', '┐', '│', '┌', '┘', '└', '┘', ' '], width: 3);
        $actual = $map->overlay($given, Point::of(1, 2));

        self::assertSame(
            <<<MAP
            .....
            .....
            .┌┐..
            .│└┐.
            .│┌┘.
            .└┘..
            .....
            MAP,
            (string)$actual,
        );

    }
}
