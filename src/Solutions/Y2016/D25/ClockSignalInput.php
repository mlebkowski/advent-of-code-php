<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D25;

use App\Realms\Computing\Instruction\Instruction;

final readonly class ClockSignalInput
{
    public function __construct(/** @var Instruction[] */ public array $instructions)
    {
    }
}
