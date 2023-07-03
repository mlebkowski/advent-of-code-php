<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D23;

use App\Aoc\Runner\InputParser;
use App\Realms\Computing\Processor\InputMatcher;

/** @implements InputParser<OpeningTheTuringLockInput> */
final class OpeningTheTuringLockInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new OpeningTheTuringLockInput(
            InputMatcher::getInstructions(
                str_replace(',', '', $input),
            ),
        );
    }
}
