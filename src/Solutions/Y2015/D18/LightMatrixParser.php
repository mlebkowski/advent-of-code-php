<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D18;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<LightMatrixInput> */
final class LightMatrixParser implements InputParser
{
    public function parse(string $input): object
    {
        return new LightMatrixInput(
            ...
            Collection::fromString($input)
                ->filter(static fn (string $light) => in_array($light, [Light::Off, Light::On], true))
                ->map(static fn (string $light) => $light === Light::On)
                ->all(),
        );
    }
}
