<?php

declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\IO\Problems\ReadWait;
use App\Realms\Computing\Processor\Processor;
use Stringable;

interface Instruction extends Stringable
{
    /**
     * @throws ReadWait
     */
    public function apply(Processor $processor): void;
}
