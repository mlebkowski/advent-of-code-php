<?php
declare(strict_types=1);

namespace App\Realms\Computing\Processor;

use App\Aoc\Parser\Matcher;
use App\Realms\Computing\Instruction\Factory\InstructionFactory;
use loophp\collection\Collection;

final class InputMatcher
{
    public static function getInstructions(string $input): array
    {
        $matcher = Matcher::create()
            ->startsWith('cpy', '%s %s', InstructionFactory::copy(...))
            ->startsWith('dec', '%s', InstructionFactory::dec(...))
            ->startsWith('hlf', '%s', InstructionFactory::halve(...))
            ->startsWith('inc', '%s', InstructionFactory::inc(...))
            ->startsWith('jie', '%s %d', InstructionFactory::jumpIfEven(...))
            ->startsWith('jio', '%s %d', InstructionFactory::jumpIfOne(...))
            ->startsWith('jmp', '%d', InstructionFactory::jump(...))
            ->startsWith('jnz', '%s %s', InstructionFactory::jumpNotZero(...))
            ->startsWith('tgl', '%s', InstructionFactory::toggle(...))
            ->startsWith('tpl', '%s', InstructionFactory::triple(...));

        return Collection::fromIterable(explode("\n", trim($input)))
            ->map($matcher)
            ->all();
    }
}
