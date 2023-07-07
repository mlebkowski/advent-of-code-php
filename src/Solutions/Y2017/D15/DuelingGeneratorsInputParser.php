<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D15;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;

/** @implements InputParser<DuelingGeneratorsInput> */
final class DuelingGeneratorsInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple(
            'Generator %s starts with %d',
            static fn (string $type, int $value) => Generator::of(GeneratorType::from($type), $value),
        );
        return new DuelingGeneratorsInput($matcher->matchLines($input));
    }
}
