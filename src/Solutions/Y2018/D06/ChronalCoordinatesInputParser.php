<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D06;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;
use App\Realms\Cartography\Point;

/** @implements InputParser<ChronalCoordinatesInput> */
final class ChronalCoordinatesInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple('%d, %d', Point::of(...));
        return new ChronalCoordinatesInput($matcher->matchLines($input));
    }
}
