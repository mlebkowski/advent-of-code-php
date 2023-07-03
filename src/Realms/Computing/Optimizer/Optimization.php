<?php
declare(strict_types=1);

namespace App\Realms\Computing\Optimizer;

use App\Realms\Computing\Instruction\Instruction;

interface Optimization
{
    public function optimize(Instruction ...$instructions): array;
}
