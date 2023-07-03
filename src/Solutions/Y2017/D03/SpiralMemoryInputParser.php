<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D03;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<SpiralMemoryInput> */
final class SpiralMemoryInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new SpiralMemoryInput((int)$input);
    }
}
