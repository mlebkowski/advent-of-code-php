<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D18;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<LikeARougeInput> */
final class LikeARougeInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new LikeARougeInput(Row::fromString($input));
    }
}
