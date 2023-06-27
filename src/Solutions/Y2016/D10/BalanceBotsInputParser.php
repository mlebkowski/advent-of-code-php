<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D10;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<BalanceBotsInput> */
final class BalanceBotsInputParser implements InputParser
{
    public function parse(string $input): object
    {
        preg_match_all(
            '/^value (?P<value>\d+) goes to bot (?P<bot>\d+)$/m',
            $input,
            $values,
            PREG_SET_ORDER,
        );

        preg_match_all(
            '/^bot (?P<bot>\d+) gives low to (?P<low>(bot|output) \d+) and high to (?P<high>(bot|output) \d+)$/m',
            $input,
            $rules,
            PREG_SET_ORDER,
        );

        return new BalanceBotsInput(
            Collection::fromIterable($values)
                ->map(static fn (array $match) => InitialDisposition::of((int)$match['bot'], (int)$match['value']))
                ->all(),
            Collection::fromIterable($rules)
                ->map(static fn (array $match) => Rule::of(
                    (int)$match['bot'],
                    Target::fromString($match['low']),
                    Target::fromString($match['high']),
                ))
                ->all(),
        );
    }
}
