<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D12;

use App\Aoc\Runner\InputParser;
use App\Realms\Computing\Instruction\Copy;
use App\Realms\Computing\Instruction\Dec;
use App\Realms\Computing\Instruction\Inc;
use App\Realms\Computing\Instruction\JumpNotZero;
use App\Realms\Computing\Processor\Register;
use loophp\collection\Collection;
use RuntimeException;

/** @implements InputParser<LeonardosMonorailInput> */
final class LeonardosMonorailInputParser implements InputParser
{
    public function parse(string $input): object
    {
        preg_match_all(
            '/^(?P<instruction>cpy|inc|dec|jnz) (?P<alpha>.+?)( (?P<bravo>.+))?$/m',
            $input,
            $matches,
            PREG_SET_ORDER,
        );

        return new LeonardosMonorailInput(
            Collection::fromIterable($matches)
                ->map(static fn (array $match) => match ($match['instruction']) {
                    'cpy' => Copy::of(
                        Register::tryFrom($match['alpha']) ?? (int)$match['alpha'],
                        Register::from($match['bravo']),
                    ),
                    'inc' => Inc::of(Register::from($match['alpha'])),
                    'dec' => Dec::of(Register::from($match['alpha'])),
                    'jnz' => JumpNotZero::of(
                        Register::tryFrom($match['alpha']) ?? (int)$match['alpha'],
                        (int)$match['bravo'],
                    ),
                    default => throw new RuntimeException("Unknown instruction: {$match['instruction']}"),
                })
                ->all(),
        );
    }
}
