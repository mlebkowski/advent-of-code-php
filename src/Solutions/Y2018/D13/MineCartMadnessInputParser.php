<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D13;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<MineCartMadnessInput> */
final class MineCartMadnessInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new MineCartMadnessInput(trim($input));
    }
}
