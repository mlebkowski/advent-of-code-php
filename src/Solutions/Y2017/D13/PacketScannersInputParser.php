<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D13;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;

/** @implements InputParser<PacketScannersInput> */
final class PacketScannersInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new PacketScannersInput(
            Matcher::simple('%d: %d', Spec::of(...))->matchLines($input),
        );
    }
}
