<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D17;

use App\Aoc\Parser\MatcherBuilder;
use App\Aoc\Runner\InputParser;
use App\Realms\Cartography\LineSegment;
use App\Realms\Cartography\Point;

/** @implements InputParser<ReservoirResearchInput> */
final class ReservoirResearchInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = MatcherBuilder::create()
            ->startsWith(
                'x=',
                '%d, y=%d..%d',
                static fn (int $x, int $minY, int $maxY) => LineSegment::between(
                    Point::of($x, $minY),
                    Point::of($x, $maxY),
                ),
            )
            ->startsWith(
                'y=',
                '%d, x=%d..%d',
                static fn (int $y, int $minX, int $maxX) => LineSegment::between(
                    Point::of($minX, $y),
                    Point::of($maxX, $y),
                ),
            )
            ->getMatcher();

        return new ReservoirResearchInput($matcher->matchLines($input));
    }
}
