<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<ChronalChargeInput> */
final class ChronalChargeInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new ChronalChargeInput((int)$input);
    }
}
