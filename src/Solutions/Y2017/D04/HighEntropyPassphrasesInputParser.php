<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D04;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<HighEntropyPassphrasesInput> */
final class HighEntropyPassphrasesInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new HighEntropyPassphrasesInput(
            Collection::fromString($input)->lines()->all(),
        );
    }
}
