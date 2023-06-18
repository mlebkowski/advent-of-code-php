<?php

declare(strict_types=1);

namespace App\Solutions\Y0000\D00;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<NAMEInput> */
final class NAMEInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new NAMEInput();
    }
}
