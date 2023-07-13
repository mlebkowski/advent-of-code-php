<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D14;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<ChocolateChartsInput> */
final class ChocolateChartsInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new ChocolateChartsInput((int)$input);
    }
}
