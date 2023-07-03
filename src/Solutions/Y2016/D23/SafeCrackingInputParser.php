<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D23;

use App\Aoc\Runner\InputParser;
use App\Realms\Computing\Processor\InputMatcher;

/** @implements InputParser<SafeCrackingInput> */
final class SafeCrackingInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new SafeCrackingInput(InputMatcher::getInstructions($input));
    }
}
