<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16\Instructions;

use App\Solutions\Y2018\D16\D16Register;
use App\Solutions\Y2018\D16\RegisterSet;

final readonly class Mulr implements D16Instruction
{
    public static function of(D16Register $alpha, D16Register $bravo, D16Register $target): self
    {
        return new self($alpha, $bravo, $target);
    }

    private function __construct(
        private D16Register $alpha,
        private D16Register $bravo,
        private D16Register $target,
    ) {
    }

    public function call(RegisterSet $input): RegisterSet
    {
        $value = $input->get($this->alpha) * $input->get($this->bravo);
        return $input->withRegisterValue($this->target, $value);
    }
}
