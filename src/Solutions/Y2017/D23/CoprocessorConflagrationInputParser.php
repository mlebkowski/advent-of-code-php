<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D23;

use App\Aoc\Runner\InputParser;
use App\Realms\Computing\Instruction\Factory\InputMatcher;

/** @implements InputParser<CoprocessorConflagrationInput> */
final class CoprocessorConflagrationInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new CoprocessorConflagrationInput(InputMatcher::getInstructions($input));
    }
}
