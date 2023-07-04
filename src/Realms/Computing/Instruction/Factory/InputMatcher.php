<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction\Factory;

use App\Aoc\Parser\MatcherBuilder;

final class InputMatcher
{
    public static function getInstructions(string $input): array
    {
        $matcher = MatcherBuilder::create()
            ->prefixed('•', InstructionFactory::debugger(...))
            ->startsWith('cpy', '%s %s', InstructionFactory::copy(...))
            ->startsWith('dec', '%s', InstructionFactory::dec(...))
            ->startsWith('hlf', '%s', InstructionFactory::halve(...))
            ->startsWith('inc', '%s', InstructionFactory::inc(...))
            ->startsWith('jie', '%s %d', InstructionFactory::jumpIfEven(...))
            ->startsWith('jio', '%s %d', InstructionFactory::jumpIfOne(...))
            ->startsWith('jmp', '%d', InstructionFactory::jump(...))
            ->startsWith('jnz', '%s %s', InstructionFactory::jumpNotZero(...))
            ->startsWith('out', '%s', InstructionFactory::out(...))
            ->startsWith('tgl', '%s', InstructionFactory::toggle(...))
            ->startsWith('tpl', '%s', InstructionFactory::triple(...))
            ->getMatcher();

        return $matcher->matchLines($input);
    }
}
