<?php

declare(strict_types=1);

namespace App\Aoc\Runner;

/** @implements InputParser<SampleInput> */
final class SampleParser implements InputParser
{
    public function parse(string $input): object
    {
        return new SampleInput();
    }
}
