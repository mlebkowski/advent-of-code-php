<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D22;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<GridComputingInput> */
final class GridComputingInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple('/dev/grid/node-x%d-y%d %dT %dT', Node::of(...));
        return new GridComputingInput(
            Collection::fromIterable(explode("\n", trim($input)))
                ->slice(2)
                ->map($matcher)
                ->all(),
        );
    }
}
