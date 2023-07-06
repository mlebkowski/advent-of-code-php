<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D12;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<DigitalPlumberInput> */
final class DigitalPlumberInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple(
            '%d <-> %...',
            static fn (int $alpha, string $targets) => Collection::fromIterable(explode(', ', $targets))
                ->map(static fn (string $bravo) => Pipe::of($alpha, (int)$bravo))
                ->all(),
        );
        return new DigitalPlumberInput($matcher->matchLines($input, flatten: true));
    }
}
