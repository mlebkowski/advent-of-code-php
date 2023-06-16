<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D18;

use loophp\collection\Collection;
use PHPUnit\Framework\TestCase;

final class LightMatrixTest extends TestCase
{
    private LightMatrix $sut;

    public static function data(): array
    {
        return [
            '0×0' => [Point::of(0, 0), 1],
            '1×0' => [Point::of(1, 0), 0],
            '2×0' => [Point::of(2, 0), 3],
            '3×0' => [Point::of(3, 0), 2],
            '4×0' => [Point::of(4, 0), 4],
            '5×0' => [Point::of(5, 0), 1],

            '0×1' => [Point::of(0, 1), 2],
            '1×1' => [Point::of(1, 1), 2],
            '2×1' => [Point::of(2, 1), 3],
            '3×1' => [Point::of(3, 1), 2],
            '4×1' => [Point::of(4, 1), 4],
            '5×1' => [Point::of(5, 1), 3],

            '0×2' => [Point::of(0, 2), 0],
            '1×2' => [Point::of(1, 2), 2],
            '2×2' => [Point::of(2, 2), 2],
            '3×2' => [Point::of(3, 2), 3],
            '4×2' => [Point::of(4, 2), 3],
            '5×2' => [Point::of(5, 2), 1],

            '0×3' => [Point::of(0, 3), 2],
            '1×3' => [Point::of(1, 3), 4],
            '2×3' => [Point::of(2, 3), 1],
            '3×3' => [Point::of(3, 3), 2],
            '4×3' => [Point::of(4, 3), 2],
            '5×3' => [Point::of(5, 3), 2],

            '0×4' => [Point::of(0, 4), 2],
            '1×4' => [Point::of(1, 4), 6],
            '2×4' => [Point::of(2, 4), 4],
            '3×4' => [Point::of(3, 4), 4],
            '4×4' => [Point::of(4, 4), 2],
            '5×4' => [Point::of(5, 4), 0],

            '0×5' => [Point::of(0, 5), 2],
            '1×5' => [Point::of(1, 5), 4],
            '2×5' => [Point::of(2, 5), 3],
            '3×5' => [Point::of(3, 5), 2],
            '4×5' => [Point::of(4, 5), 2],
            '5×5' => [Point::of(5, 5), 1],
        ];
    }

    /** @dataProvider data */
    public function test count adjacent lights(Point $point, int $expected): void
    {
        $actual = $this->sut->countAdjacentLights($point);

        self::assertSame($expected, $actual);
    }

    public function test indexing is correct(): void
    {
        $point = Point::of(3, 2);
        $actual = $this->sut->at($point)->point;

        self::assertEquals($actual, $point);
    }

    public function test indexing does not wrap(): void
    {
        $actual = $this->sut->at(Point::of(6, 0));

        self::assertNull($actual);
    }

    public function test corners(): void
    {
        $actual = Collection::fromIterable($this->sut->corners())
            ->map(static fn (Point $point) => (string)$point)
            ->sort()
            ->implode(', ');

        self::assertSame('0×0, 0×5, 5×0, 5×5', $actual);
    }

    public function setUp(): void
    {
        $this->sut = (new LightMatrixParser())->parse(
            "
            .#.#.#
            ...##.
            #....#
            ..#...
            #.#..#
            ####..
            ",
        )->matrix;
    }
}
