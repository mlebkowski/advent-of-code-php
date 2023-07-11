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

    public function test from string(): void
    {
        $given = <<<EOF
        ##.#.#..
        .#.#.#.#
        ....#.#.
        #.#.##.#
        .##.#...
        ##..#..#
        .#...#..
        ##.#.##.
        EOF;

        $actual = Map::fromString($given);

        self::assertSame($given, (string)$actual);

    }

    public function test cut out(): void
    {
        $given = Map::fromString(
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
        );

        $actual = $given->cutOut(Area::covering(Point::center(), Point::of(x: 3, y: 3)));
        self::assertSame(
            <<<EOF
            ##.#
            .#.#
            ....
            #.#.
            EOF,
            (string)$actual,
        );
    }

    public function test frame(): void
    {
        $given = Map::fromString(
            <<<MAP
            ##.#
            .#.#
            ....
            #.#.
            MAP,
        );
        $actual = $given->framed();
        self::assertSame(
            <<<MAP
            ┌────┐
            │##.#│
            │.#.#│
            │....│
            │#.#.│
            └────┘
            MAP,
            (string)$actual,
        );
    }

    public function test rotate(): void
    {
        $given = Map::fromString(
            <<<MAP
            .#.
            ..#
            ###
            MAP
        );

        $actual = $given->rotate();
        self::assertSame(
            <<<MAP
            .##
            #.#
            ..#
            MAP,
            (string)$actual,
        );
    }

    public function test flip vertical(): void
    {
        $given = Map::fromString(
            <<<MAP
            .#.
            ..#
            ###
            MAP
        );

        $actual = $given->flipVertical();
        self::assertSame(
            <<<MAP
            ###
            ..#
            .#.
            MAP,
            (string)$actual,
        );
    }

    public function test flip horizontal(): void
    {
        $given = Map::fromString(
            <<<MAP
            .#.
            ..#
            ###
            MAP
        );

        $actual = $given->flipHorizontal();
        self::assertSame(
            <<<MAP
            .#.
            #..
            ###
            MAP,
            (string)$actual,
        );
    }

    public function test border(): void
    {
        $given = Map::fromString(
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
        );

        $border = $given->border();
        $actual = $given->overlayPath($border);

        self::assertSame(
            <<<EOF
            ┌──────┐
            │#.#.#.│
            │...#.#│
            │.#.##.│
            │##.#..│
            │#..#..│
            │#...#.│
            └──────┘
            EOF,
            (string)$actual,
        );

    }
}
