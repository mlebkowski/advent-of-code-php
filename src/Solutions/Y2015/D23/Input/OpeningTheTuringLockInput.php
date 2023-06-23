<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D23\Input;

use App\Solutions\Y2015\D23\Instruction\Instruction;

final readonly class OpeningTheTuringLockInput
{
    public function __construct(/** @var Instruction[] */ public array $instructions)
    {
    }
}
