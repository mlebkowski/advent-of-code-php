<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D21;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;

/** @implements InputParser<FractalArtInput> */
final class FractalArtInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple('%s => %s', EnchancementRule::fromStrings(...));
        return new FractalArtInput($matcher->matchLines($input));
    }
}
