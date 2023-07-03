<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D12;

use App\Aoc\Runner\InputParser;
use App\Realms\Computing\Processor\InputMatcher;

/** @implements InputParser<LeonardosMonorailInput> */
final class LeonardosMonorailInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new LeonardosMonorailInput(InputMatcher::getInstructions($input));
    }
}
