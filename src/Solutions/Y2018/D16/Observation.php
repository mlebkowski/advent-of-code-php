<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16;

final readonly class Observation
{
    public static function of(RegisterSet $before, InstructionCall $operation, RegisterSet $after): self
    {
        return new self($before, $operation, $after);
    }

    private function __construct(
        public RegisterSet $before,
        public InstructionCall $operation,
        public RegisterSet $after,
    ) {
    }
}
