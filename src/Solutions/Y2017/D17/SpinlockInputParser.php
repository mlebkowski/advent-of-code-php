<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D17;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<SpinlockInput> */
final class SpinlockInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new SpinlockInput((int)$input);
    }
}
