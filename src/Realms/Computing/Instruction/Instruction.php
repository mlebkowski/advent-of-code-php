<?php

declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Processor;
use Stringable;

interface Instruction extends Stringable
{
    public function apply(Processor $processor): void;
}
