<?php
declare(strict_types=1);

namespace App\Realms\Computing\Optimizer;

final class OptimizerFactory
{
    public static function make(): Optimizer
    {
        return Optimizer::of(new IncToMulOptimization());
    }
}
