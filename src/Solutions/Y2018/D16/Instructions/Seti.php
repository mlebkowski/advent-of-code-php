<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16\Instructions;

use App\Solutions\Y2018\D16\D16Register;
use App\Solutions\Y2018\D16\RegisterSet;

final readonly class Seti implements D16Instruction
{
    public static function of(int $value, D16Register $target): self
    {
        return new self($value, $target);
    }

    private function __construct(
        private int $value,
        private D16Register $target,
    ) {
    }

    public function call(RegisterSet $input): RegisterSet
    {
        return $input->withRegisterValue($this->target, $this->value);
    }
}
