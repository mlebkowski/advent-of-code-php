<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D08;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;

/** @implements InputParser<IHeardYouLikeRegistersInput> */
final class IHeardYouLikeRegistersInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple(
            '%s %s %d if %s %s %d',
            static fn ($reg, $op, $value, $otherRegister, $comparison, $otherValue) => Instruction::of(
                $reg,
                Operation::from($op),
                $value,
                $otherRegister,
                Comparison::from($comparison),
                $otherValue,
            ),
        );

        return new IHeardYouLikeRegistersInput($matcher->matchLines($input));
    }
}
