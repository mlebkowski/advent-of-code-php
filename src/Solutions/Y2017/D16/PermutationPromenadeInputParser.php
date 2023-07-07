<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D16;

use App\Aoc\Parser\MatcherBuilder;
use App\Aoc\Runner\InputParser;
use App\Solutions\Y2017\D16\DanceMoves\Exchange;
use App\Solutions\Y2017\D16\DanceMoves\Partner;
use App\Solutions\Y2017\D16\DanceMoves\Spin;

/** @implements InputParser<PermutationPromenadeInput> */
final class PermutationPromenadeInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = MatcherBuilder::create()
            ->startsWith('s', '%d', Spin::of(...))
            ->startsWith('x', '%d/%d', Exchange::of(...))
            ->startsWith('p', '%c/%c', Partner::of(...))
            ->getMatcher();
        return new PermutationPromenadeInput($matcher->matchLines($input, delim: ','));
    }
}
