<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D10;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<KnotHashInput> */
final class KnotHashInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $asIntegers = array_map(static fn (string $value) => (int)$value, explode(',', trim($input)));
        return new KnotHashInput($asIntegers, trim($input));
    }
}
