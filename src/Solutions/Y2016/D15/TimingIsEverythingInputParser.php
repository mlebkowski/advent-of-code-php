<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D15;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<TimingIsEverythingInput> */
final class TimingIsEverythingInputParser implements InputParser
{
    public function parse(string $input): object
    {
        preg_match_all(
            '/^Disc #(?P<num>\d+) has (?P<size>\d+) positions; '
            . 'at time=0, it is at position (?P<position>\d+).$/m',
            $input,
            $matches,
            PREG_SET_ORDER,
        );
        return new TimingIsEverythingInput(
            Collection::fromIterable($matches)
                ->map(
                    static fn (array $match) => Disc::of(
                        (int)$match['size'],
                        (int)$match['position'] + (int)$match['num'],
                    ),
                )
                ->all(),
        );
    }
}
