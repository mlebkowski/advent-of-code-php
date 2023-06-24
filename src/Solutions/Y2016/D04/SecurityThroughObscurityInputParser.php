<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D04;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<SecurityThroughObscurityInput> */
final class SecurityThroughObscurityInputParser implements InputParser
{
    public function parse(string $input): object
    {
        preg_match_all(
            '/^(?P<name>[\d\w-]+)-(?P<sectorId>\d+)\[(?P<checksum>.{5})]$/m',
            $input,
            $matches,
            PREG_SET_ORDER,
        );
        return new SecurityThroughObscurityInput(
            Collection::fromIterable($matches)
                ->map(static fn (array $match) => Room::of(
                    $match['name'],
                    (int)$match['sectorId'],
                    $match['checksum'],
                ))
                ->all(),
        );
    }
}
