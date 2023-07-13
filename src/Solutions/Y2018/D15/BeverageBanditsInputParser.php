<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D15;

use App\Aoc\Runner\InputParser;
use App\Realms\Cartography\Map;

/** @implements InputParser<BeverageBanditsInput> */
final class BeverageBanditsInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new BeverageBanditsInput(Map::fromString(trim($input)));
    }
}
