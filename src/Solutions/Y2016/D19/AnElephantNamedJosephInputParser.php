<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D19;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<AnElephantNamedJosephInput> */
final class AnElephantNamedJosephInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new AnElephantNamedJosephInput((int)$input);
    }
}
