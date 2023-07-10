<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D22;

use App\Aoc\Runner\InputParser;
use App\Realms\Cartography\Map;

/** @implements InputParser<SporificaVirusInput> */
final class SporificaVirusInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new SporificaVirusInput(Map::fromString(trim($input)));
    }
}
