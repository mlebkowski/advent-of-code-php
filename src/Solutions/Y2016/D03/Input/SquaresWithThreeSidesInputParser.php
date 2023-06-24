<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D03\Input;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<SquaresWithThreeSidesInput> */
final class SquaresWithThreeSidesInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $triplets = Collection::fromString($input)
            ->lines()
            ->flatMap(static fn (string $row) => preg_split('/\s+/', trim($row)))
            ->map(static fn (string $value) => (int)$value)
            ->chunk(3)
            ->all();

        return new SquaresWithThreeSidesInput($triplets);
    }
}
