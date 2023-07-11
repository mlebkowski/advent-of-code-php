<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D07;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;

/** @implements InputParser<TheSumOfItsPartsInput> */
final class TheSumOfItsPartsInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple(
            'Step %c must be finished before step %c can begin.',
            AssemblyRule::of(...),
        );
        return new TheSumOfItsPartsInput($matcher->matchLines($input));
    }
}
