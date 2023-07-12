<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D10;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;
use App\Realms\Physics\Vector;

/** @implements InputParser<TheStarsAlignInput> */
final class TheStarsAlignInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple(
            'position=<%d, %d> velocity=<%d, %d>',
            static fn (int $x, int $y, int $dx, int $dy) => Star::of(
                Vector::of($x, $y),
                Vector::of($dx, $dy),
            ),
        );
        return new TheStarsAlignInput($matcher->matchLines($input));
    }
}
