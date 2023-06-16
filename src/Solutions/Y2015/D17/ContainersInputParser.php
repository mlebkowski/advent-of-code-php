<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D17;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<ContainersInput> */
final class ContainersInputParser implements InputParser
{
    public function parse(string $input): ContainersInput
    {
        return new ContainersInput(
            Collection::fromString($input)
                ->lines()
                ->map(static fn (string $value) => intval($value))
                ->all(),
        );
    }
}
