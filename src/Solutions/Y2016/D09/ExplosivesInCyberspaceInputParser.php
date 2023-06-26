<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D09;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<ExplosivesInCyberspaceInput> */
final class ExplosivesInCyberspaceInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new ExplosivesInCyberspaceInput(trim($input));
    }
}
