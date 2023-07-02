<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D20;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<FirewallRulesInput> */
final class FirewallRulesInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new FirewallRulesInput(
            Collection::fromString($input)
                ->lines()
                ->map(static fn (string $line) => Range::of(
                    ...array_map(intval(...), explode('-', $line)),
                ))
                ->all(),
        );
    }
}
