<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D03\Builder;

use App\Realms\Cartography\Orientation;
use App\Realms\Cartography\Point;
use App\Realms\Cartography\Turn;
use Generator;

final readonly class SpiralBuilder
{
    public static function adjacent(): Generator
    {
        return self::of(new AdjacentValueFactory())->build();
    }

    public static function sequential(): Generator
    {
        return self::of(new SequentialValueFactory())->build();
    }

    public static function of(ValueFactory $valueFactory): self
    {
        return new self($valueFactory);
    }

    private function __construct(private ValueFactory $valueFactory)
    {
    }

    public function build(): Generator
    {
        $point = $start = Point::center();
        $spiral = [
            (string)$start => 1,
        ];

        yield $start => 1;

        $direction = Orientation::East;
        $i = $sideLength = $ringEnd = $cornerValue = 1;

        while (true) {
            $point = $point->inDirection($direction);
            $i++;

            yield $point => $spiral[(string)$point] = $this->valueFactory->forPoint($point, $i, $spiral);

            if ($i > $ringEnd) {
                $sideLength += 2;
                $ringEnd = $sideLength ** 2;
                $cornerValue = $i + $sideLength - 2;
                $direction = $direction->turn(Turn::Right);
            }

            if ($i === $cornerValue && $i !== $ringEnd) {
                $direction = $direction->turn(Turn::Right);
                $cornerValue += $sideLength - 1;
            }
        }
    }
}
