<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D01;

use App\Aoc\Runner\InputParser;
use App\Lib\Type\Cast;
use loophp\collection\Collection;

/** @implements InputParser<ChronalCalibrationInput> */
final class ChronalCalibrationInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new ChronalCalibrationInput(
            Collection::fromString($input)
                ->lines()
                ->map(Cast::toInt(...))
                ->all(),
        );
    }
}
