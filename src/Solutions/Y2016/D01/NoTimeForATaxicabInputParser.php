<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D01;

use App\Aoc\Runner\InputParser;
use App\Realms\Cartography\Turn;
use loophp\collection\Collection;

/** @implements InputParser<NoTimeForATaxicabInput> */
final class NoTimeForATaxicabInputParser implements InputParser
{
    public function parse(string $input): object
    {
        preg_match_all('/(?P<turn>[LR])(?P<distance>\d+)/', $input, $matches, PREG_SET_ORDER);
        return new NoTimeForATaxicabInput(
            Collection::fromIterable($matches)
                ->map(
                    static fn (array $match) => Instruction::of(
                        Turn::from($match['turn']),
                        (int)$match['distance'],
                    ),
                )
                ->all(),
        );
    }
}
