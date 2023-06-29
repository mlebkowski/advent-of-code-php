<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D16;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<DragonChecksumInput> */
final class DragonChecksumInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new DragonChecksumInput(trim($input));
    }
}
