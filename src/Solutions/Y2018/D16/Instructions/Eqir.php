<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16\Instructions;

use App\Solutions\Y2018\D16\D16Register;
use App\Solutions\Y2018\D16\RegisterSet;

final readonly class Eqir implements D16Instruction
{
    public static function of(int $alpha, D16Register $bravo, D16Register $target): self
    {
        return new self($alpha, $bravo, $target);
    }

    private function __construct(
        private int $alpha,
        private D16Register $bravo,
        private D16Register $target,
    ) {
    }

    public function call(RegisterSet $input): RegisterSet
    {
        $value = ($this->alpha === $input->get($this->bravo)) ? 1 : 0;
        return $input->withRegisterValue($this->target, $value);
    }
}
