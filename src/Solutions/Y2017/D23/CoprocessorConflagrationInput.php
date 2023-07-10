<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D23;

use App\Realms\Computing\Instruction\Instruction;

final readonly class CoprocessorConflagrationInput
{
    public function __construct(/** @var Instruction[] */ public array $instructions)
    {
    }
}
