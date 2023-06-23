<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D24;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<ItHangsInTheBalanceInput> */
final class ItHangsInTheBalanceInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new ItHangsInTheBalanceInput(
            array_map(intval(...), explode("\n", trim($input))),
        );
    }
}
