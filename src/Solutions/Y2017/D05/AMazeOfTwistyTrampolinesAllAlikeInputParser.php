<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D05;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<AMazeOfTwistyTrampolinesAllAlikeInput> */
final class AMazeOfTwistyTrampolinesAllAlikeInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new AMazeOfTwistyTrampolinesAllAlikeInput(
            Collection::fromString($input)
                ->lines()
                ->map(static fn (string $row) => (int)$row)
                ->all(),
        );
    }
}
