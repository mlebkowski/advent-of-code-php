<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D02;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<CorruptionChecksumInput> */
final class CorruptionChecksumInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new CorruptionChecksumInput(
            Collection::fromString($input)
                ->lines()
                ->map(static fn (string $row) => array_map(intval(...), preg_split('/\s+/', $row)))
                ->all(),
        );
    }
}
