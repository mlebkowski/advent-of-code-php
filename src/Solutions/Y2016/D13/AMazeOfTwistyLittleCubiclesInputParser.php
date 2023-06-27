<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D13;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<AMazeOfTwistyLittleCubiclesInput> */
final class AMazeOfTwistyLittleCubiclesInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new AMazeOfTwistyLittleCubiclesInput((int)$input);
    }
}
