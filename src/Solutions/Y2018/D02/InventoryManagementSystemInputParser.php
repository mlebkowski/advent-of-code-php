<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D02;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;

/** @implements InputParser<InventoryManagementSystemInput> */
final class InventoryManagementSystemInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple('%s', Id::of(...));
        return new InventoryManagementSystemInput($matcher->matchLines($input));
    }
}
