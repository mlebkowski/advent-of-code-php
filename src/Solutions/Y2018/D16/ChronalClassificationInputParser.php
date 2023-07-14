<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D16;

use App\Aoc\Parser\Matcher;
use App\Aoc\Parser\ReMatcher;
use App\Aoc\Runner\InputParser;

/** @implements InputParser<ChronalClassificationInput> */
final class ChronalClassificationInputParser implements InputParser
{
    public function parse(string $input): object
    {
        [$observations, $sample] = explode("\n\n\n", $input);
        $reMatcher = ReMatcher::of(
            <<<PATTERN
            Before: [%d, %d, %d, %d]
            %d %d %d %d
            After:  [%d, %d, %d, %d]
            PATTERN,
            static fn ($ba, $bb, $bc, $bd, $op, $a, $b, $t, $aa, $ab, $ac, $ad) => Observation::of(
                RegisterSet::of($ba, $bb, $bc, $bd),
                InstructionCall::of(Opcode::from($op), $a, $b, D16Register::from($t)),
                RegisterSet::of($aa, $ab, $ac, $ad),
            ),
        );

        $matcher = Matcher::simple(
            '%d %d %d %d',
            static fn ($op, $a, $b, $t) => InstructionCall::of(
                Opcode::from($op),
                $a,
                $b,
                D16Register::from($t),
            ),
        );

        return new ChronalClassificationInput(
            $reMatcher->match($observations),
            $matcher->matchLines($sample),
        );
    }
}
