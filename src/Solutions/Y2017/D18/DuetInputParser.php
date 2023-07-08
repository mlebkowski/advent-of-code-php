<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D18;

use App\Aoc\Runner\InputParser;
use App\Realms\Computing\Instruction\Factory\InputMatcher;

/** @implements InputParser<DuetInput> */
final class DuetInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new DuetInput(InputMatcher::getInstructions($input));
    }
}
