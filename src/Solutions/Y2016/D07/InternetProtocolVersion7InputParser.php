<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D07;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<InternetProtocolVersion7Input> */
final class InternetProtocolVersion7InputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new InternetProtocolVersion7Input(
            Collection::fromString($input)
                ->lines()
                ->map(Ipv7::fromString(...))
                ->all(),
        );
    }
}
