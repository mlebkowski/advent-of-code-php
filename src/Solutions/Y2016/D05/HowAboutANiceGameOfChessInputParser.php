<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D05;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<HowAboutANiceGameOfChessInput> */
final class HowAboutANiceGameOfChessInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new HowAboutANiceGameOfChessInput(trim($input));
    }
}
