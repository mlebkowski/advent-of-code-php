<?php
declare(strict_types=1);

namespace App\Realms\Computing\Optimizer;

use App\Realms\Computing\Instruction\Add;
use App\Realms\Computing\Instruction\Copy;
use App\Realms\Computing\Instruction\Factory\ArgumentFactory;
use App\Realms\Computing\Instruction\Multiply;

final readonly class IncToMulOptimizationFactory
{
    public static function make(): Optimization
    {
        $pattern = <<<EOF
        cpy :value :regAlpha
        inc :regTarget
        dec :regAlpha
        jnz :regAlpha -2
        dec :regBravo
        jnz :regBravo -5
        EOF;

        $useMultiplication = static fn (array $matches) => [
            Multiply::of(
                ArgumentFactory::expectRegister($matches['regBravo']),
                ArgumentFactory::registerOrValue($matches['value']),
            ),
            Add::of(
                ArgumentFactory::expectRegister($matches['regTarget']),
                ArgumentFactory::expectRegister($matches['regBravo']),
            ),
            Copy::of(0, ArgumentFactory::expectRegister($matches['regAlpha'])),
            Copy::of(0, ArgumentFactory::expectRegister($matches['regBravo'])),
        ];

        return PatternMatcherOptimization::of($pattern, $useMultiplication);
    }
}
