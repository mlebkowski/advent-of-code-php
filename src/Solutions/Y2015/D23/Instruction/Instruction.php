<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D23\Instruction;

use App\Solutions\Y2015\D23\Processor;
use Stringable;

interface Instruction extends Stringable
{
    public function apply(Processor $processor): void;
}
