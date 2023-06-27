<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D23;

use App\Aoc\Runner\InputParser;
use App\Realms\Computing\Instruction\Halve;
use App\Realms\Computing\Instruction\Inc;
use App\Realms\Computing\Instruction\Jump;
use App\Realms\Computing\Instruction\JumpIfEven;
use App\Realms\Computing\Instruction\JumpIfOne;
use App\Realms\Computing\Instruction\Triple;
use App\Realms\Computing\Processor\Register;
use loophp\collection\Collection;
use RuntimeException;

/** @implements InputParser<OpeningTheTuringLockInput> */
final class OpeningTheTuringLockInputParser implements InputParser
{
    public function parse(string $input): object
    {
        preg_match_all(
            '/^
            (?P<instruction>hlf|tpl|inc|jmp|jie|jio)
            \s+
            (?P<value>.+?)
            (, \s+ (?P<offset>.+))?
            $/mx',
            $input,
            $matches,
            PREG_SET_ORDER,
        );

        return new OpeningTheTuringLockInput(
            Collection::fromIterable($matches)
                ->map(static fn (array $match) => match ($match['instruction']) {
                    'inc' => Inc::of(Register::from($match['value'])),
                    'hlf' => Halve::of(Register::from($match['value'])),
                    'tpl' => Triple::of(Register::from($match['value'])),
                    'jmp' => Jump::of((int)$match['value']),
                    'jie' => JumpIfEven::of(Register::from($match['value']), (int)$match['offset']),
                    'jio' => JumpIfOne::of(Register::from($match['value']), (int)$match['offset']),
                    default => throw new RuntimeException("Unknown instruction: {$match['instruction']}"),
                })
                ->all(),
        );
    }
}
