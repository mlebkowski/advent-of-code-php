<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D18;

use App\Aoc\Runner\InputParser;
use App\Realms\Cartography\Map;

/** @implements InputParser<SettlersOfTheNorthPoleInput> */
final class SettlersOfTheNorthPoleInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new SettlersOfTheNorthPoleInput(Map::fromString(trim($input)));
    }
}
