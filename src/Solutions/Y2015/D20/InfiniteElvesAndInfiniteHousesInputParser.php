<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D20;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<InfiniteElvesAndInfiniteHousesInput> */
final class InfiniteElvesAndInfiniteHousesInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new InfiniteElvesAndInfiniteHousesInput((int)$input);
    }
}
