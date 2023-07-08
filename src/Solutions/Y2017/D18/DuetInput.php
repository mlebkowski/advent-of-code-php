<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D18;

use App\Realms\Computing\Instruction\Instruction;

final readonly class DuetInput
{
    public function __construct(/** @var Instruction[] */ public array $instructions)
    {
    }
}
