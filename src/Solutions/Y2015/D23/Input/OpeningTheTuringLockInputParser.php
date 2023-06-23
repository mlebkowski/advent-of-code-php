<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D23\Input;

use App\Aoc\Runner\InputParser;
use App\Solutions\Y2015\D23\Instruction\Halve;
use App\Solutions\Y2015\D23\Instruction\Inc;
use App\Solutions\Y2015\D23\Instruction\Jump;
use App\Solutions\Y2015\D23\Instruction\JumpIfEven;
use App\Solutions\Y2015\D23\Instruction\JumpIfOne;
use App\Solutions\Y2015\D23\Instruction\Register;
use App\Solutions\Y2015\D23\Instruction\Triple;
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
