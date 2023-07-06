<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D14;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<DiskDefragmentationInput> */
final class DiskDefragmentationInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new DiskDefragmentationInput(trim($input));
    }
}
