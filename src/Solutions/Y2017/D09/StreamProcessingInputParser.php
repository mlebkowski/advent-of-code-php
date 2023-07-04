<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D09;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<StreamProcessingInput> */
final class StreamProcessingInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new StreamProcessingInput(trim($input));
    }
}
