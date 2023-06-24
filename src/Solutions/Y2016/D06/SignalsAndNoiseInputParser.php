<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D06;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<SignalsAndNoiseInput> */
final class SignalsAndNoiseInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new SignalsAndNoiseInput(
            Collection::fromString($input)->lines()->all(),
        );
    }
}
