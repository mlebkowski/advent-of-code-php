<?php
declare(strict_types=1);

namespace App\Realms\Computing\Optimizer;

use App\Realms\Computing\Instruction\Add;
use App\Realms\Computing\Instruction\Copy;
use App\Realms\Computing\Instruction\Factory\ArgumentFactory;
use App\Realms\Computing\Instruction\Instruction;
use App\Realms\Computing\Instruction\Multiply;
use App\Realms\Computing\Instruction\Noop;

final class IncToMulOptimization implements Optimization
{
    public function optimize(Instruction ...$instructions): array
    {
        $result = $instructions;
        foreach ($instructions as $idx => $instruction) {
            $chunk = array_slice($instructions, $idx, 6);
            $replacement = $this->detectedMultiplication($chunk);
            if ($replacement) {
                array_splice($result, $idx, 6, $replacement);
            }
        }
        return $result;
    }

    private function detectedMultiplication(array $chunk): false|array
    {
        $toAssembly = implode("\n", $chunk);

        $expectedPattern = [
            'cpy (?P<value>\w+) (?P<regAlpha>\w+)',
            'inc (?P<regTarget>\w+)',
            'dec \g{regAlpha}',
            'jnz \g{regAlpha} -2',
            'dec (?P<regBravo>\w+)',
            'jnz \g{regBravo} -5',
        ];

        preg_match(
            sprintf('/^%s$/', implode("\n", $expectedPattern)),
            $toAssembly,
            $matches,
        );

        if (!$matches) {
            return false;
        }

        return [
            Multiply::of(
                ArgumentFactory::registerOrValue($matches['value']),
                ArgumentFactory::expectRegister($matches['regBravo']),
            ),
            Add::of(
                ArgumentFactory::expectRegister($matches['regBravo']),
                ArgumentFactory::expectRegister($matches['regTarget']),
            ),
            Copy::of(0, ArgumentFactory::expectRegister($matches['regAlpha'])),
            Copy::of(0, ArgumentFactory::expectRegister($matches['regBravo'])),
            Noop::instruction(),
            Noop::instruction(),
        ];
    }
}
