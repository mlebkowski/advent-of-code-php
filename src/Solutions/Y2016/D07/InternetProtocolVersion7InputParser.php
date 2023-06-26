<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D07;

use App\Aoc\Runner\InputParser;
use App\Solutions\Y2016\D07\Factory\Ipv7Factory;
use loophp\collection\Collection;

/** @implements InputParser<InternetProtocolVersion7Input> */
final class InternetProtocolVersion7InputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new InternetProtocolVersion7Input(
            Collection::fromIterable(explode("\n", $input))
                ->map(Ipv7Factory::fromString(...))
                ->all(),
        );
    }
}
