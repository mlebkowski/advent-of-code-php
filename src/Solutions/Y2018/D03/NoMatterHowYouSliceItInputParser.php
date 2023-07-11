<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D03;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;
use App\Realms\Cartography\Area;
use App\Realms\Cartography\Point;

/** @implements InputParser<NoMatterHowYouSliceItInput> */
final class NoMatterHowYouSliceItInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple(
            '#%d @ %d,%d: %dx%d',
            static fn (int $id, int $x, int $y, int $width, int $height) => Claim::of(
                $id,
                Area::covering(
                    Point::of($x, $y),
                    Point::of($x + $width - 1, $y + $height - 1),
                ),
            ),
        );
        return new NoMatterHowYouSliceItInput($matcher->matchLines($input));
    }
}
