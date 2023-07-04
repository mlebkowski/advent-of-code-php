<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D07;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;

/** @implements InputParser<RecursiveCircusInput> */
final class RecursiveCircusInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple(
            '%s (%d) -> %...',
            static fn (string $name, int $weight, string $above = '') => Shout::of(
                Program::of($name, $weight),
                ...$above ? explode(', ', $above) : [],
            ),
        );
        return new RecursiveCircusInput($matcher->matchLines($input));
    }
}
