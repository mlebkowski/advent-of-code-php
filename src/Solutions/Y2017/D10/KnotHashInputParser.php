<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D10;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<KnotHashInput> */
final class KnotHashInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $asIntegers = array_map(static fn (string $value) => (int)$value, explode(',', trim($input)));
        $asCharCodes = Collection::fromString(trim($input))
            ->map(static fn (string $char) => ord($char))
            ->all();
        return new KnotHashInput($asIntegers, $asCharCodes);
    }
}
