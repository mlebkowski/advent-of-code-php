<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D24;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;

/** @implements InputParser<ElectromagneticMoatInput> */
final class ElectromagneticMoatInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple('%d/%d', Component::of(...));
        return new ElectromagneticMoatInput($matcher->matchLines($input));
    }
}
