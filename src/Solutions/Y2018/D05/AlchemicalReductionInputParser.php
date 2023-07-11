<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D05;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<AlchemicalReductionInput> */
final class AlchemicalReductionInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new AlchemicalReductionInput(trim($input));
    }
}
