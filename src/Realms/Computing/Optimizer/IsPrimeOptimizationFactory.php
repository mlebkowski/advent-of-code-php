<?php
declare(strict_types=1);

namespace App\Realms\Computing\Optimizer;

use App\Realms\Computing\Instruction\Factory\ArgumentFactory;

final class IsPrimeOptimizationFactory
{
    public static function make(): Optimization
    {
        $pattern = <<<EOF
        set :regResult 1
        set :regAlpha 2
        set :regBravo 2
        set :regOper :regAlpha
        mul :regOper :regBravo
        sub :regOper :regInput
        jnz :regOper +2
        set :regResult 0
        sub :regBravo -1
        set :regOper :regBravo
        sub :regOper :regInput
        jnz :regOper -8
        sub :regAlpha -1
        set :regOper :regAlpha
        sub :regOper :regInput
        jnz :regOper -13
        EOF;

        $useIsPrime = static fn (array $matches) => [
            IsPrime::of(
                ArgumentFactory::expectRegister($matches['regResult']),
                ArgumentFactory::registerOrValue($matches['regInput']),
            ),
        ];
        return PatternMatcherOptimization::of($pattern, $useIsPrime);
    }
}
