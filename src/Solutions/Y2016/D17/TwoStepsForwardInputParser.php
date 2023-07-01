<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D17;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<TwoStepsForwardInput> */
final class TwoStepsForwardInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new TwoStepsForwardInput(trim($input));
    }
}
