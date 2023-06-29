<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D14;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<OneTimePadInput> */
final class OneTimePadInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new OneTimePadInput(trim($input));
    }
}
