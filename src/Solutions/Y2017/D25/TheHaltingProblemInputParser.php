<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D25;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<TheHaltingProblemInput> */
final class TheHaltingProblemInputParser implements InputParser
{
    public function parse(string $input): object
    {
        preg_match(
            '/Begin in state (?P<state>\w).+checksum after (?P<steps>\d+) steps/s',
            $input,
            $matches,
        );

        preg_match_all(
            <<<RE
            /In state (?P<state>\\w+):
              If the current value is 0:
                - Write the value (?P<write0>\\d).
                - Move one slot to the (?P<move0>\\w+).
                - Continue with state (?P<next0>\\w).
              If the current value is 1:
                - Write the value (?P<write1>\\d).
                - Move one slot to the (?P<move1>\\w+).
                - Continue with state (?P<next1>\\w)./
            RE,
            $input,
            $rules,
            PREG_SET_ORDER,
        );
        $states = Collection::fromIterable($rules)
            ->map(static fn (array $match) => State::of(
                $match['state'],
                Rule::of(
                    Value::from((int)$match['write0']),
                    TapeDirection::from($match['move0']),
                    $match['next0'],
                ),
                Rule::of(
                    Value::from((int)$match['write1']),
                    TapeDirection::from($match['move1']),
                    $match['next1'],
                ),
            ))
            ->all();

        return new TheHaltingProblemInput(
            Blueprint::of(
                $matches['state'],
                (int)$matches['steps'],
                ...$states,
            ),
        );
    }
}
