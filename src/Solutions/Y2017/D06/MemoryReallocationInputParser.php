<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D06;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<MemoryReallocationInput> */
final class MemoryReallocationInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new MemoryReallocationInput(
            Collection::fromIterable(preg_split('/\s+/', trim($input)))
                ->map(static fn (string $blocks) => (int)$blocks)
                ->all(),
        );
    }
}
