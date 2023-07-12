<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D12;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;

/** @implements InputParser<SubterraneanSustainabilityInput> */
final class SubterraneanSustainabilityInputParser implements InputParser
{
    public function parse(string $input): object
    {
        [$initialState] = sscanf($input, 'initial state: %s');
        $matcher = Matcher::simple(
            '%c%c%c%c%c => %c',
            static fn ($l1, $l2, $pot, $r1, $r2, $res) => Rule::of(
                Pot::from($res),
                Pot::from($l1),
                Pot::from($l2),
                Pot::from($pot),
                Pot::from($r1),
                Pot::from($r2),
            ),
        );

        return new SubterraneanSustainabilityInput(Population::of(
            Pot::fromMany($initialState),
            $matcher->matchLines($input, skip: 2),
        ));
    }
}
