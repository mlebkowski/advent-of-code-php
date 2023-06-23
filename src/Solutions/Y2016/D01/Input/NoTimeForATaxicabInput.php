<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D01\Input;

final readonly class NoTimeForATaxicabInput
{
    public function __construct(/** @var Instruction[] */ public array $instructions)
    {
    }
}
