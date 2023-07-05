<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D11;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;

/** @implements InputParser<HexEdInput> */
final class HexEdInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new HexEdInput(
            Matcher::simple('%s', HexDirection::from(...))->matchLines($input, delim: ','),
        );
    }
}
