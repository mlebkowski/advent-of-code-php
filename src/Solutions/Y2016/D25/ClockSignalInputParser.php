<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D25;

use App\Aoc\Runner\InputParser;
use App\Realms\Computing\Instruction\Factory\InputMatcher;

/** @implements InputParser<ClockSignalInput> */
final class ClockSignalInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new ClockSignalInput(InputMatcher::getInstructions($input));
    }
}
