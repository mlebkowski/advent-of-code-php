<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D02;

use App\Aoc\Runner\InputParser;
use App\Solutions\Y2016\D02\Move\Direction;
use App\Solutions\Y2016\D02\Move\Move;
use loophp\collection\Collection;

/** @implements InputParser<BathroomSecurityInput> */
final class BathroomSecurityInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $moves = Collection::fromString($input)
            ->lines()
            ->map(
                static fn (string $line) => Collection::fromString($line)
                    ->map(static fn (string $char) => Direction::from($char))->all(),
            )
            ->map(static fn (array $directions) => new Move($directions))
            ->all();

        return new BathroomSecurityInput($moves);
    }
}
